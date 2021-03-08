<?php


namespace frontend\controllers;

use Carbon\Carbon;
use common\components\shoppingcart\ShoppingCart;
use common\helpers\PembayaranHelper;
use common\models\HargaNego;
use common\models\Keranjang;
use common\models\Payment;
use common\models\Pembayaran;
use common\models\PembayaranCicilan;
use common\models\PembayaranTransaksiPermintaan;
use common\models\PermintaanProduk;
use common\models\Produk;
use common\models\Transaksi;
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
use yii\data\ArrayDataProvider;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UnprocessableEntityHttpException;

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

    public function beforeAction($action)
    {
        switch ($action->id){
            case 'notifikasi': case 'confirm-order':
            $this->enableCsrfValidation = false;
            Config::$serverKey = Yii::$app->params['midtrans_server_key'];

            Config::$isSanitized = true;
            Config::$is3ds = true;
                break;
        }
        return parent::beforeAction($action);
    }

    public function actionCheckout()
    {
        /** @var $user User */
        $user = Yii::$app->user->identity;

        $keranjang = Yii::$app->cart;
        $keranjangDataProvider = new ArrayDataProvider(['allModels' => $keranjang->getItems()]);


        if (empty($user->nomor_hp)) {
            $flash = FlashHelper::DANGER;
            $flash['message'] = 'Untuk bisa bertransaksi, verifikasi dulu nomor hp anda.';
            $flash['title'] = 'Verifikasi Nomor Hp!';
            Yii::$app->session->setFlash('danger', $flash);
            return $this->redirect(['settings/account']);
        }
        return $this->render('checkout', compact('user', 'keranjangDataProvider', 'keranjang'));
    }


    public function actionBelisekarang()
    {
        /** @var $user User */

        $user = Yii::$app->user->identity;

        $data = Yii::$app->request->post();
        $is_nego = filter_var($data['is_nego'], FILTER_VALIDATE_BOOLEAN);
        $is_diskon = filter_var($data['is_diskon'], FILTER_VALIDATE_BOOLEAN);

        $cart = Yii::$app->cart;
        $product = Produk::findOne($data['produk']);
        $cart->create($product);



        if ($is_nego) {
            $harganego = HargaNego::findOne(['id_produk' => $product->id, 'id_user' => $data['user']]);
            $cart->getItemById($product->id)->setNegoPrice($harganego);
        }


        if ($is_diskon) {
            $diskon = $product->diskon;
            $cart->getItemById($product->id)->setDiscount($diskon);
        }
        $cart->save();
        $keranjangDataProvider = new ArrayDataProvider(['allModels' => $cart->getItems()]);


        // if (empty($user->nomor_hp)) {
        //     $flash = FlashHelper::DANGER;
        //     $flash['message'] = 'Untuk bisa bertransaksi, verifikasi dulu nomor hp anda.';
        //     $flash['title'] = 'Verifikasi Nomor Hp!';
        //     Yii::$app->session->setFlash('danger', $flash);
        //     return $this->redirect(['settings/account']);
        // }

        return $this->render('checkout', compact('user', 'keranjangDataProvider'));
    }

    public function actionProceedPayment()
    {

    }
    public function actionConfirmOrder()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $cart = Yii::$app->cart;
        $db = Yii::$app->db->beginTransaction();
        $req = Yii::$app->request->post('data');
        $isCicilan = $req['isCicilan'];
        $jumlahCicilan = $req['jumlahCicilan'];
        $user = Yii::$app->user->identity;
        $now = Carbon::now();
        $jenis = $isCicilan? TransaksiProduk::JENIS_TRANSAKSI_CICIL : TransaksiProduk::JENIS_TRANSAKSI_TUNAI;

        $transaksi = null;
        try {
            //set up model transaksi
            $transaksi = $this->setUpTransaksiProduk($user, $jenis, $cart, $now);

            // setup transaksi detail
            $items = $this->setUpDetailTransaksi($transaksi, $cart);

            if ($isCicilan) {
                $cicilan = new TransaksiCicilan();
                $cicilan->banyak_cicilan = $jumlahCicilan;
                $cicilan->id_transaksi = $transaksi->id;
                $cicilan->tanggal_jatuh_tempo = Carbon::now()->day;
                $cicilan->jumlah_cicilan = round($transaksi->grand_total/ $jumlahCicilan);
                $cicilan->status = TransaksiCicilan::STATUS_ONGOING;
                $cicilan->save(false);

                $bayarCicilan = new PembayaranCicilan();
                $bayarCicilan->id_transaksi_cicilan = $cicilan->id;
                $bayarCicilan->jumlah_dibayar = $cicilan->jumlah_cicilan;
                $bayarCicilan->tanggal_pembayaran = $now;
                $bayarCicilan->status = PembayaranHelper::STATUS_PENDING;
                $bayarCicilan->save(false);
            }

            //set up model pembayaran
            $this->setupPayment($transaksi, $items, $isCicilan, $jumlahCicilan);
            $db->commit();
        } catch (Exception $exception) {
            $db->rollBack();
            throw $exception;
        }

        if ($transaksi) {
            Yii::$app->cart->deleteAll();
            //TODO: send email or something

            return ['payment_token'=>$transaksi->payment_token, 'payment_url'=>$transaksi->payment_url];
        }



        return [];
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionNotifikasi()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $paymentNotification = new Notification();

//        $validatSignatureKey = hash('sha512', $paymentNotification->order_id . $paymentNotification->status_code . $paymentNotification->gross_amount . Yii::$app->params['midtrans_server_key']);
//        if ($paymentNotification->signatur_key  !== $validatSignatureKey) {
//            throw new ForbiddenHttpException('Invalid Signature');
//        }

       $code = substr($paymentNotification->order_id,0,3);
        $statusCode = null;

        $order = null;
        $type = null;
        if (TransaksiProduk::TRANSAKSI_CODE === $code) {
            $order = TransaksiProduk::findOne(['code'=>$paymentNotification->order_id]);
            $type = TransaksiProduk::class;
            $jenis = Payment::JENIS_PRODUK;
        } elseif (TransaksiCicilan::TRANSAKSI_CODE === $code) {
            $order = TransaksiCicilan::findOne(['code'=>$paymentNotification->order_id]);
            $type = TransaksiCicilan::class;
            $jenis = Payment::JENIS_CICILAN;
        } elseif (TransaksiPermintaan::TRANSAKSI_CODE === $code) {
            $order = TransaksiPermintaan::findOne(['code'=>$paymentNotification->order_id]);
            $type = TransaksiPermintaan::class;
            $jenis = Payment::JENIS_PERMINTAAN;
        }

        if ($order->isPaid()) {
            throw new UnprocessableEntityHttpException('Already paid');
        }

        $transaction = $paymentNotification->transaction_status;
        $paymentType = $paymentNotification->payment_type;
        $orderId = $paymentNotification->order_id;
        $fraud = $paymentNotification->fraud_status;

        $vaNumber = null;
        $vendorName = null;
        if (!empty($paymentNotification->va_numbers[0])) {
            $vaNumber = $paymentNotification->va_numbers[0]->va_number;
            $vendorName = $paymentNotification->va_numbers[0]->bank;
        }


        $paymentStatus = null;
        if ($transaction === 'capture') {

            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($paymentType === 'credit_card') {
                if ($fraud === 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    $paymentStatus = Payment::STATUS_CHALLENGED;
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    $paymentStatus = Payment::STATUS_SUCCESS;
                }
            }
        } elseif ($transaction === 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $paymentStatus = Payment::STATUS_SETTLEMENT;
        } elseif ($transaction === 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $paymentStatus = Payment::STATUS_PENDING;
        } elseif ($transaction === 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            $paymentStatus = PAYMENT::STATUS_DENIED;
        } elseif ($transaction === 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $paymentStatus = PAYMENT::STATUS_EXPIRED;
        } elseif ($transaction === 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            $paymentStatus = PAYMENT::STATUS_CANCELED;
        }

        $paymentParams = [
            'external_id' => $order->id,
            'type'=> $type,
            'jenis_pembayaran'=>$paymentType,
            'kode_pembayaran' => Payment::generateKodePembayaran($jenis),
            'nominal' => $paymentNotification->gross_amount,
            'status' => $paymentStatus,
            'token' => $paymentNotification->transaction_id,
            'payloads' => $paymentNotification->getResponse(),
            'payment_type' => $paymentNotification->payment_type,
            'va_number' => $vaNumber,
            'vendor_name' => $vendorName,
            'biller_code' => $paymentNotification->biller_code,
            'bill_key' => $paymentNotification->bill_key,
        ];

        $payment = new Payment();
        $payment->setAttributes($paymentParams);

        $db = Yii::$app->db->beginTransaction();
            try{
                $payment->save(false);
                if ($paymentStatus && $payment) {
                    if($payment->status === Payment::STATUS_SETTLEMENT || $payment->status === Payment::STATUS_SUCCESS){
                        $order->payment_status = Transaksi::PAYMENT_STATUS_PAID;
                        $order->status = Transaksi::STATUS_CONFIRMED;
                        $order->save(false);
                    }
                }
                $db->commit();


            } catch (Exception $exception){
                $db->rollBack();
                throw $exception;
            }
        $message = 'Payment status is : ' . $paymentStatus;

        $response = [
            'code' => 200,
            'message' => $message,
        ];

        return $response;
    }

    public function actionCicilan()
    {
    }


    public function actionSelesai()
    {
        $code =  Yii::$app->request->get('order_id');
        $order = null;
        $codeOrder = substr($code,0,3);
        if (TransaksiProduk::TRANSAKSI_CODE === $codeOrder) {
            $order = TransaksiProduk::findOne(['code'=>$code]);
            $jenis = TransaksiProduk::TRANSAKSI_PRODUK;

        } elseif (TransaksiCicilan::TRANSAKSI_CODE === $codeOrder) {
            $order = TransaksiCicilan::findOne(['code'=>$code]);
            $jenis = TransaksiCicilan::TRANSAKSI_CICILAN;

        } elseif (TransaksiPermintaan::TRANSAKSI_CODE=== $codeOrder) {
            $order = TransaksiPermintaan::findOne(['code'=>$code]);
            $jenis = TransaksiPermintaan::TRANSAKSI_PERMINTAAN;
        }

        if ($order->payment_status == Transaksi::PAYMENT_STATUS_UNPAID) {
            return  $this->redirect(['pembayaran/gagal','order_id'=>$code]);
        }

        Yii::$app->session->setFlash('success', "Thank you for completing the payment process!");

        return  $this->redirect(['transaksi/received','jenis'=>$jenis,'id_transaksi'=>$order->id]);
    }

    public function actionTidakSelesai()
    {
        $code = Yii::$app->request->get('order_id');
        $order = null;
        $codeOrder = substr($code,0,3);

        $jenis = null;
        if (TransaksiProduk::TRANSAKSI_CODE === $codeOrder) {
            $order = TransaksiProduk::findOne(['code'=>$code]);
            $jenis = TransaksiProduk::TRANSAKSI_PRODUK;

        } elseif (TransaksiCicilan::TRANSAKSI_CODE === $codeOrder) {
            $order = TransaksiCicilan::findOne(['code'=>$code]);
            $jenis = TransaksiCicilan::TRANSAKSI_CICILAN;

        } elseif (TransaksiPermintaan::TRANSAKSI_CODE=== $codeOrder) {
            $order = TransaksiPermintaan::findOne(['code'=>$code]);
            $jenis = TransaksiPermintaan::TRANSAKSI_PERMINTAAN;
        }


        Yii::$app->session->setFlash('error', "Sorry, we couldn't process your payment.");

        return $this->redirect(['transaksi/received','id'=>$order->id,'jenis'=>$jenis]);
    }

    public function actionGagal()
    {
        $code = Yii::$app->request->get('order_id');
        $order = null;
        $codeOrder = substr($code,0,3);

        $jenis = null;
        if (TransaksiProduk::TRANSAKSI_CODE === $codeOrder) {
            $order = TransaksiProduk::findOne(['code'=>$code]);
            $jenis = TransaksiProduk::TRANSAKSI_PRODUK;

        } elseif (TransaksiCicilan::TRANSAKSI_CODE === $codeOrder) {
            $order = TransaksiCicilan::findOne(['code'=>$code]);
            $jenis = TransaksiCicilan::TRANSAKSI_CICILAN;

        } elseif (TransaksiPermintaan::TRANSAKSI_CODE=== $codeOrder) {
            $order = TransaksiPermintaan::findOne(['code'=>$code]);
            $jenis = TransaksiPermintaan::TRANSAKSI_PERMINTAAN;
        }

        return $this->redirect(['transaksi/received','jenis'=>$jenis,'id_transaksi'=>$order->id]);
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
            'enabled_payments'=>Payment::PAYMENT_CHANNELS,
            'transaction_details' => $transactionDetail,
            'customer_details' => $customerDetail,
            'item_details' => [
                [
                    'id' => $transaksi->id,
                    'price' => $total,
                    'quantity' => 1,
                    'name' => $transaksi->transaksiPermintaan->permintaan->nama . '(' . $transaksi->jenisString . ')'
                ]

            ],
        ];
        $snapToken = Snap::getSnapToken($snapPayload);

        $transaksi->payment_token = $snapToken;

        return ['snap_token' => $snapToken];
    }

    public function actionConfirmCicilan()
    {
    }

    private function setUpTransaksiProduk($user, $jenis, $cart, $now)
    {
        $transaksi = new TransaksiProduk();
        if (isset($user)) {
            $transaksi->id_user = $user->id;
        }
        $transaksi->code = $transaksi->genereateTransactionCode($jenis);
        $transaksi->status = Transaksi::STATUS_INVOICE;
        $transaksi->jenis_transaksi = $jenis;
        $transaksi->order_date = $now->timestamp;
        $transaksi->payment_due = $now->addDay()->timestamp;
        $transaksi->payment_status = Transaksi::PAYMENT_STATUS_UNPAID;
        $transaksi->base_total_price = $cart->getCost();

        if ($promo = $cart->getPromo()) {
            $transaksi->discount_percent = $promo->persentase;
            $transaksi->discount_amount = ($transaksi->base_total_price * ($promo->persentase)/100);
        }

        $transaksi->tax_percent = TransaksiProduk::TAX_PERCENTAGE;
        $transaksi->tax_amount = $transaksi->discount_amount? ($transaksi->base_total_price - $transaksi->discount_amount) * TransaksiProduk::TAX_PERCENTAGE : $transaksi->base_total_price * TransaksiProduk::TAX_PERCENTAGE;

        $transaksi->grand_total = $transaksi->discount_amount ? ($transaksi->base_total_price - $transaksi->discount_amount) + $transaksi->tax_amount : $transaksi->base_total_price + $transaksi->tax_amount;

        return $transaksi->save(false) ? $transaksi: null;
    }

    private function setUpDetailTransaksi(?TransaksiProduk $transaksi, ShoppingCart $cart)
    {
        $items = [];
        foreach ($cart->getItems() as /** @var $produk Produk */ $produk) {
            $item = [
                'id' => $produk->id,
                'price' => $produk->getCost(),
                'quantity' => 1,
                'name' => $produk->nama
            ];
            $items[] = $item;

            $transaksiDetail = new TransaksiDetail();
            $transaksiDetail->id_transaksi = $transaksi->id;
            $transaksiDetail->id_produk = $produk->id;
            $transaksiDetail->base_price = $produk->getPrice();
            $transaksiDetail->discount_percent = $produk->diskon? $produk->diskon->persentase : null;
            $transaksiDetail->bargain_price = $produk->getNegoPrice()? $produk->getNegoPrice()->harga: null;
            $transaksiDetail->sub_total = $produk->getCost();
            $transaksiDetail->save(false);
        }
        return $items;
    }

    private function setupPayment(Transaksi $transkasi, array $items, $isCicilan = false, $cicilan = null)
    {
        $user = Yii::$app->user->identity;
        $transactionDetail = [
            'order_id' => $transkasi->getCode(),
            'gross_amount' => $cicilan ? $cicilan->jumlah_cicilan : $transkasi->grand_total
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
            'enable_payments'=>Payment::PAYMENT_CHANNELS,
            'transaction_details' => $transactionDetail,
            'customer_details' => $customerDetail,
            'item_details' => $items,
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s T'),
                'unit' => 'DAY',
                'duration' => 1,
            ],
        ];
        $snapToken = Snap::createTransaction($snapPayload);

        if ($snapToken) {
            $transkasi->payment_token = $snapToken->token;
            $transkasi->payment_url = $snapToken->redirect_url;
            $transkasi->save(false);
        }
    }
}
