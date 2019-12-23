<?php


namespace frontend\controllers;


use Carbon\Carbon;
use common\models\Keranjang;
use common\models\Transaksi;
use common\models\TransaksiCicilan;
use common\models\TransaksiDetail;
use common\models\User;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\Response;

class PembayaranController extends Controller
{

    public function actionCheckout()
    {

        /** @var $user User */
        $user = Yii::$app->user->identity;

        $keranjang = Keranjang::find()->where(['id_user' => $user->id]);
        $keranjangDataProvider = new ActiveDataProvider(['query' => $keranjang]);
        if (empty($user->nomor_hp)) {
            Yii::$app->session->setFlash('success', [
                'type' => 'danger',
                'icon' => 'fas fa-stop',
                'message' => 'Untuk bisa bertransaksi, verifikasi dulu nomor hp anda.',
                'title' => 'Verifikasi Nomor Hp!',
            ]);
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
        $transaksi = new Transaksi();
        $transaksi->id_user = $user->id;
        $transaksi->total = $req['total'];
        $transaksi->status = Transaksi::STATUS_PENDING;
        $transaksi->expire = $waktu->addHours(8)->timestamp;
        $transaksi->kode_transaksi = 'devmall-' . $waktu->timestamp;
        $transaksi->waktu = $waktu->timestamp;
        $transaksi->save(false);

        if ($isCicilan) {
            $cicilan = new TransaksiCicilan();
            $cicilan->banyak_cicilan = $jumlahCicilan;
            $cicilan->id_transaksi = $transaksi->id;
            $cicilan->tanggal_jatuh_tempo = Carbon::now()->day;
            $cicilan->jumlah_cicilan = round($total / $jumlahCicilan);
            $cicilan->status = TransaksiCicilan::STATUS_ONGOING;
            $cicilan->save(false);
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
            $detailTransaksi->is_promo = false;
            $detailTransaksi->harga_transaksi = $produk->produk->harga;
            $detailTransaksi->save(false);

        }
        $snapPayload = [
            'transaction_details' => $transactionDetail,
            'customer_details' => $customerDetail,
            'item_details' => $itemDetails
        ];
        $snapToken = Snap::getSnapToken($snapPayload);

        $transaksi->snap_token = $snapToken;
        $returns = ['snap_token' => $snapToken];
        try {


            $transaksi->update(false);
            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
        }


        return $returns;


    }


    public function actionNotifikasi()
    {
        $notif = new Notification();
        $db = Yii::$app->db->beginTransaction();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $orderId = $notif->orderId;
        $fraud = $notif->fraud_status;
        $transaksi = Transaksi::findOne(['kode_transaksi' => $orderId]);

        if ($transaction === 'capture') {
            if ($fraud === 'challenge') {
                $transaksi->status = Transaksi::STATUS_PENDING;
            } else {
                $transaksi->status = Transaksi::STATUS_SUCCESS;
            }
        } elseif ($transaction == 'pending') {


            $transaksi->status = Transaksi::STATUS_PENDING;

        } elseif ($transaction == 'deny') {

            $transaksi->status = Transaksi::STATUS_FAILED;

        } elseif ($transaction == 'expire') {

            $transaksi->status = Transaksi::STATUS_EXPIRED;
        } elseif ($transaction == 'cancel') {

            $transaksi->status = Transaksi::STATUS_FAILED;
        }
    }
}