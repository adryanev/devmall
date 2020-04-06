<?php


namespace frontend\controllers;

use Carbon\Carbon;
use common\models\Keranjang;
use common\models\PermintaanProduk;
use common\models\RiwayatTransaksiPermintaan;
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

    public function actionCheckoutTest()
    {
        $this->enableCsrfValidation=false;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $transaction = file_get_contents('php://input');

        // Change "app.sandbox.midtrans.com" to "app.midtrans.com" when you are deploying to production environment

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://app.sandbox.midtrans.com/snap/v1/transactions",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $transaction,
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "Authorization: Basic U0ItTWlkLXNlcnZlci1uNHZVMElOSGl3WXk4aVMzX1VNTFlVN1c6",
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    public function actionNotificationTest()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $this->enableCsrfValidation=false;
        require_once(dirname(__FILE__) . '/Veritrans.php');
        Veritrans_Config::$isProduction = false;
        Veritrans_Config::$serverKey = 'SB-Mid-server-n4vU0INHiwYy8iS3_UMLYU7W';



        if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {


            try {
                $notif = new Veritrans_Notification();
            } catch (Exception $e) {
                echo "Exception: ".$e->getMessage()."\r\n";
                echo "Notification received: ".file_get_contents("php://input");
                exit();
            }
            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $order_id = $notif->order_id;
            $fraud = $notif->fraud_status;
            if ($transaction == 'capture') {
                // For credit card transaction, we need to check whether transaction is challenge by FDS or not
                if ($type == 'credit_card'){
                    if($fraud == 'challenge'){
                        // TODO set payment status in merchant's database to 'Challenge by FDS'
                        // TODO merchant should decide whether this transaction is authorized or not in MAP
                        echo "Transaction order_id: " . $order_id ." is challenged by FDS";
                    }
                    else {
                        // TODO set payment status in merchant's database to 'Success'
                        echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
                    }
                }
            }
            else if ($transaction == 'settlement'){
                // TODO set payment status in merchant's database to 'Settlement'
                echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
            }
            else if($transaction == 'pending'){
                // TODO set payment status in merchant's database to 'Pending'
                echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
            }
            else if ($transaction == 'deny') {
                // TODO set payment status in merchant's database to 'Denied'
                echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
            }
            else if ($transaction == 'expire') {
                // TODO set payment status in merchant's database to 'expire'
                echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
            }
            else if ($transaction == 'cancel') {
                // TODO set payment status in merchant's database to 'Denied'
                echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
            }


        } else {


            //
            // order_id=776981683&status_code=200&transaction_status=capture

            $order_id = $_GET['order_id'];
            $statusCode = $_GET['status_code'];
            $transaction  = $_GET['transaction_status'];


            if($transaction == 'capture') {
                echo "<p>Transaksi berhasil.</p>";
                echo "<p>Status transaksi untuk order id : " . $order_id;

            }
            // Deny
            else if($transaction == 'deny') {
                echo "<p>Transaksi ditolak.</p>";
                echo "<p>Status transaksi untuk order id .: " . $order_id;

            }
            // Challenge
            else if($transaction == 'challenge') {
                echo "<p>Transaksi challenge.</p>";
                echo "<p>Status transaksi untuk order id : " . $order_id;

            }
            // Error
            else {
                echo "<p>Terjadi kesalahan pada data transaksi yang dikirim.</p>";
                echo "<p>Status message: [$response->status_code] " . $transaction;
            }


        }
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
        $transaksi = new TransaksiProduk();
        $transaksi->id_user = $user->id;
        $transaksi->total = $req['total'];
        $transaksi->status = TransaksiProduk::STATUS_PENDING;
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
            $produk->delete();
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
        $transaksi = TransaksiProduk::findOne(['kode_transaksi' => $orderId]);

        if ($transaction === 'capture') {
            if ($fraud === 'challenge') {
                $transaksi->status = TransaksiProduk::STATUS_PENDING;
            } else {
                $transaksi->status = TransaksiProduk::STATUS_SUCCESS;
            }
        } elseif ($transaction == 'pending') {
            $transaksi->status = TransaksiProduk::STATUS_PENDING;
        } elseif ($transaction == 'deny') {
            $transaksi->status = TransaksiProduk::STATUS_FAILED;
        } elseif ($transaction == 'expire') {
            $transaksi->status = TransaksiProduk::STATUS_EXPIRED;
        } elseif ($transaction == 'cancel') {
            $transaksi->status = TransaksiProduk::STATUS_FAILED;
        }
    }

    public function actionCicilan()
    {
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


        $transaksi = RiwayatTransaksiPermintaan::findOne($data['data']['id']);
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
