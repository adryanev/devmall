<?php


namespace frontend\controllers;

use Carbon\Carbon;
use common\helpers\PembayaranHelper;
use common\models\Keranjang;
use common\models\Pembayaran;
use common\models\PembayaranCicilan;
use common\models\PembayaranTransaksiPermintaan;
use common\models\PermintaanProduk;
use common\models\TransaksiCicilan;
use common\models\TransaksiDetail;
use common\models\TransaksiPermintaan;
use common\models\TransaksiProduk;
use common\models\User;
use frontend\helpers\FlashHelper;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class PembayaranController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'cicilan' => ['POST'],
                    'permintaan' => ['POST'],
                    'confirm-order' => ['POST']
                ]
            ],
        ];
    }

    public function actionCheckout()
    {

        /** @var $user User */
        $user = Yii::$app->user->identity;

        $keranjang = Keranjang::find()->where(['id_user' => $user->id]);
        $keranjangDataProvider = new ActiveDataProvider(['query' => $keranjang]);
        if (empty($user->nomor_hp)) {
            $flash = FlashHelper::DANGER;
            $flash['message'] = 'Untuk bisa bertransaksi, verifikasi dulu nomor hp anda.';
            $flash['title'] = 'Verifikasi Nomor Hp!';
            Yii::$app->session->setFlash('danger', $flash);
            return $this->redirect(['settings/account']);
        }
        return $this->render('checkout', compact('user', 'keranjangDataProvider'));
    }

    public function actionConfirmOrder()
    {
        Config::$serverKey = Yii::$app->params['midtrans_server_key'];

        Config::$isSanitized = true;
        Config::$is3ds = true;


        Yii::$app->response->format = Response::FORMAT_JSON;

        $db = Yii::$app->db->beginTransaction();
        $itemDetails = [];
        $req = Yii::$app->request->post('data');
        $isCicilan = $req['isCicilan'];
        $jumlahCicilan = $req['jumlahCicilan'];
        $total = $req['total'];
        $keranjang = $req['keranjang'];
        $user = User::findOne($req['user']['id']);
        $waktu = Carbon::now();
        $sekarang = $waktu;

        $pembayaran = new Pembayaran();
        $transaksi = new TransaksiProduk();
        if (isset($user)) {
            $transaksi->id_user = $user->id;
        }
        $transaksi->status = TransaksiProduk::STATUS_PENDING;
        $transaksi->jenis_transaksi = $isCicilan? TransaksiProduk::JENIS_TRANSAKSI_CICIL : TransaksiProduk::JENIS_TRANSAKSI_TUNAI;
//        $transaksi->total = $req['total'];
        $pembayaran->nominal = $req['total'];
        $pembayaran->status = PembayaranHelper::STATUS_PENDING;


        $pembayaran->expire = $waktu->addDay()->timestamp;
        $pembayaran->kode_pembayaran = 'devmall-produk-' . $waktu->timestamp;
        $pembayaran->waktu = $waktu->timestamp;
        $transaksi->save(false);
        $pembayaran->save(false);

        if ($isCicilan) {
            $cicilan = new TransaksiCicilan();
            $cicilan->banyak_cicilan = $jumlahCicilan;
            $cicilan->id_transaksi = $transaksi->id;
            $cicilan->tanggal_jatuh_tempo = Carbon::now()->day;
            $cicilan->jumlah_cicilan = round($total / $jumlahCicilan);
            $cicilan->status = TransaksiCicilan::STATUS_ONGOING;
            $cicilan->save(false);

            $bayarCicilan = new PembayaranCicilan();
            $bayarCicilan->id_transaksi_cicilan = $cicilan->id;
            $bayarCicilan->jumlah_dibayar = $cicilan->jumlah_cicilan;
            $bayarCicilan->tanggal_pembayaran = $sekarang;
            $bayarCicilan->status = PembayaranHelper::STATUS_PENDING;
            $bayarCicilan->save(false);
        }

        $transactionDetail = [
            'order_id' => $transaksi->kode_transaksi,
            'gross_amount' => $isCicilan ? $cicilan->jumlah_cicilan : $total
        ];
        $billingAddress = [
            'first_name' => $user->profilUser->nama_depan,
            'last_name' => $user->profilUser->nama_belakang,
            'address' => $user->profilUser->alamat1,
            'city' => $user->profilUser->kota,
            'country_code' => 'IDN'
        ];
        $customerDetail = [
            'first_name' => $user->profilUser->nama_depan,
            'last_name' => $user->profilUser->nama_belakang,
            'email' => $user->email,
            'phone' => $user->nomor_hp,
            'billing_address' => $billingAddress,
            'shipping_address' => $billingAddress
        ];

        foreach ($keranjang as $value) {
            $produk = Keranjang::findOne($value['id']);
            $item = [
                'id' => $produk->id,
                'price' => $produk->produk->harga,
                'quantity' => 1,
                'name' => $produk->produk->nama
            ];
            $itemDetails[] = $item;
            $detailTransaksi = new TransaksiDetail();
            $detailTransaksi->id_transaksi = $transaksi->id;
            $detailTransaksi->id_produk = $produk->id_produk;
            $detailTransaksi->is_promo = $produk->is_diskon;
            //TODO: Check apakah produk diskon

            $detailTransaksi->harga_transaksi = $produk->produk->harga;
            $detailTransaksi->save(false);
            $produk->delete();
        }
        $snapPayload = [
            'transaction_details' => $transactionDetail,
            'customer_details' => $customerDetail,
            'item_details' => $itemDetails
        ];
        $snapToken = Snap::getSnapToken($snapPayload);

        $pembayaran->snap_token = $snapToken;
        $returns = ['snap_token' => $snapToken];
        try {
            $transaksi->update(false);
            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
        }


        return $returns;
    }


    /**
     * @throws NotFoundHttpException
     */
    public function actionNotifikasi()
    {
        $notif = new Notification();
        $db = Yii::$app->db->beginTransaction();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;
        $pembayaran = Pembayaran::findOne(['kode_transaksi' => $order_id]);

        if (!$pembayaran) {
            throw new NotFoundHttpException();
        }
        if ($transaction === 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($fraud === 'challenge') {
                // TODO set payment status in merchant's database to 'Challenge by FDS'
                // TODO merchant should decide whether this transaction is authorized or not in MAP
                $pembayaran->status = PembayaranHelper::STATUS_CHALLENGED;
                echo "Transaction order_id: " . $order_id ." is challenged by FDS";
            } else {
                // TODO set payment status in merchant's database to 'Success'
                $pembayaran->status = PembayaranHelper::STATUS_SUCCESS;
                echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
            }
        } elseif ($transaction === 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $pembayaran->status = PembayaranHelper::STATUS_SUCCESS;
            echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
        } elseif ($transaction === 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $pembayaran->status = PembayaranHelper::STATUS_PENDING;
            echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
        } elseif ($transaction === 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            $pembayaran->status = PembayaranHelper::STATUS_DENIED;
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
        } elseif ($transaction === 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $pembayaran->status = PembayaranHelper::STATUS_EXPIRED;
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
        } elseif ($transaction === 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            $pembayaran->status = PembayaranHelper::STATUS_DENIED;
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
        }
    }

    public function actionCicilan()
    {
    }

    public function actionSelesai(){

        var_dump(Yii::$app->request->params);
    }
    public function actionTidakSelesai(){
        var_dump(Yii::$app->request->params);
    }

    public function actionGagal(){
        var_dump(Yii::$app->request->params);
    }

    public function actionPermintaan()
    {
        $post = Yii::$app->request->post();
        $permintaan = $this->findPermintaan($post['id']);
        $transaksiPermintaan = $this->findTransaksiPermintaan($permintaan->id);
        $riwayat = $transaksiPermintaan->getTransaksiBelumDibayar()->one();

        return $this->render('permintaan', [
            'riwayat' => $riwayat,
            'user' => Yii::$app->user->identity,
            'transaksiPermintaan' => $transaksiPermintaan
        ]);
    }

    protected function findPermintaan($id)
    {
        $permintaan = PermintaanProduk::findOne($id);
        if (!$permintaan) {
            throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
        }

        return $permintaan;
    }

    protected function findTransaksiPermintaan($id)
    {
        $transaksi = TransaksiPermintaan::findOne(['id_permintaan' => $id]);
        if (!$transaksi) {
            throw new NotFoundHttpException();
        }
        return $transaksi;
    }

    public function actionConfirmPermintaan()
    {
        Config::$serverKey = Yii::$app->params['midtrans_server_key'];

        Config::$isSanitized = true;
        Config::$is3ds = true;


        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Yii::$app->request->post();

        $user = Yii::$app->user->identity;


        $transaksi = PembayaranTransaksiPermintaan::findOne($data['data']['id']);
        $total = $data['data']['total'];

        $transactionDetail = [
            'order_id' => $transaksi->id,
            'gross_amount' => $total
        ];
        $billingAddress = [
            'first_name' => $user->profilUser->nama_depan,
            'last_name' => $user->profilUser->nama_belakang,
            'address' => $user->profilUser->alamat1,
            'city' => $user->profilUser->kota,
            'country_code' => 'IDN'
        ];
        $customerDetail = [
            'first_name' => $user->profilUser->nama_depan,
            'last_name' => $user->profilUser->nama_belakang,
            'email' => $user->email,
            'phone' => $user->nomor_hp,
            'billing_address' => $billingAddress,
            'shipping_address' => $billingAddress
        ];

        $snapPayload = [
            'transaction_details' => $transactionDetail,
            'customer_details' => $customerDetail,
            'item_details' => [
                [  'id' => $transaksi->id,
                    'price' => $total,
                    'quantity' => 1,
                    'name' => $transaksi->transaksiPermintaan->permintaan->nama . '(' . $transaksi->jenisString . ')'
                ]

            ]
        ];
        $snapToken = Snap::getSnapToken($snapPayload);

        $transaksi->snap_token = $snapToken;

        return ['snap_token' => $snapToken];
    }

    public function actionConfirmCicilan()
    {
    }
}
