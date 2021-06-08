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
                    'confirm-order' => ['POST'],
                    'confirm-permintaan' => ['POST']
                ]
            ],
        ];
    }

    public function beforeAction($action)
    {
        switch ($action->id) {
            case 'notifikasi': case 'confirm-order': case 'confirm-permintaan':case 'confirm-cicilan':
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

        $keranjang = Yii::$app->cart;
        $product = Produk::findOne($data['produk']);
        $keranjang->create($product);



        if ($is_nego) {
            $harganego = HargaNego::findOne(['id_produk' => $product->id, 'id_user' => $data['user']]);
            $keranjang->getItemById($product->id)->setNegoPrice($harganego);
        }


        if ($is_diskon) {
            $diskon = $product->diskon;
            $keranjang->getItemById($product->id)->setDiscount($diskon);
        }
        $keranjang->save();
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
    public function actionConfirmOrder()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $cart = Yii::$app->cart;
        $db = Yii::$app->db->beginTransaction();
        $req = Yii::$app->request->post('data');
        $isCicilan = filter_var($req['isCicilan'], FILTER_VALIDATE_BOOLEAN); //true
        $jumlahCicilan = $req['jumlahCicilan']; // 6

        $user = Yii::$app->user->identity;
        $now = Carbon::now();
        $jenis = $isCicilan? TransaksiProduk::JENIS_TRANSAKSI_CICIL : TransaksiProduk::JENIS_TRANSAKSI_TUNAI;

        $cicilan = null;
        $transaksi = null;
        $bayarCicilan = null;
        try {
            //set up model transaksi
            $transaksi = $this->setUpTransaksiProduk($user, $jenis, $cart, $now);

            if ($isCicilan) {
                $cicilan = new TransaksiCicilan();
                $cicilan->banyak_cicilan = $jumlahCicilan;
                $cicilan->id_transaksi = $transaksi->id;
                $cicilan->tanggal_jatuh_tempo = $now->isoFormat('YYYY-MM-DD');
                $cicilan->jumlah_cicilan = round($transaksi->grand_total/ $jumlahCicilan); //1833
                //TODO: tambahakan jumlah_cicilan_non_pajak
                $cicilan->status = TransaksiCicilan::STATUS_ONGOING;
                $cicilan->save(false);

                $bayarCicilan = new PembayaranCicilan();
                $bayarCicilan->id_transaksi_cicilan = $cicilan->id;
                $bayarCicilan->jumlah_dibayar = $cicilan->jumlah_cicilan; //1833
                $bayarCicilan->tanggal_pembayaran = Carbon::now()->timestamp;
                $bayarCicilan->code = $bayarCicilan->generateCode();
                $bayarCicilan->payment_status = Transaksi::PAYMENT_STATUS_UNPAID;
                $bayarCicilan->status = Payment::STATUS_PENDING;
                $bayarCicilan->save(false);

            }

            // setup transaksi detail
            $items = $this->setUpDetailTransaksi($transaksi, $cart);

            //set up model pembayaran
            $this->setupPayment($transaksi, $items, $isCicilan, $cicilan, $bayarCicilan);
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

    public function actionProceedPayment()
    {
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

        $code = substr($paymentNotification->order_id, 0, 3);
        $statusCode = null;

        $transaction = $paymentNotification->transaction_status;
        $paymentType = $paymentNotification->payment_type;
        $orderId = $paymentNotification->order_id;
        $fraud = $paymentNotification->fraud_status;

        $order = null;
        $type = null;

        $vaNumber = null;
        $vendorName = null;
        if (!empty($paymentNotification->va_numbers[0])) {
            $vaNumber = $paymentNotification->va_numbers[0]->va_number;
            $vendorName = $paymentNotification->va_numbers[0]->bank;
        }

        if (TransaksiProduk::TRANSAKSI_CODE === $code) {
            $order = TransaksiProduk::findOne(['code'=>$orderId]);
            $type = TransaksiProduk::class;
            $jenis = Payment::JENIS_PRODUK;
        } elseif (TransaksiCicilan::TRANSAKSI_CODE === $code) {
//            $order = TransaksiCicilan::findOne(['code'=>$orderId]);
            $bayarCicilan = PembayaranCicilan::findOne(['code'=>$orderId]);
            $order = $bayarCicilan->transaksiCicilan;
            $type = TransaksiCicilan::class;
            $jenis = Payment::JENIS_CICILAN;
        } elseif (PembayaranTransaksiPermintaan::TRANSAKSI_CODE === $code) {

//            $order = TransaksiPermintaan::findOne(['code'=>$orderId]);
            $bayarPermintaan = PembayaranTransaksiPermintaan::findOne(['code'=>$orderId]);
            $order = $bayarPermintaan->transaksiPermintaan;
            $type = TransaksiPermintaan::class;
            $jenis = Payment::JENIS_PERMINTAAN;
            $order->sudah_dibayar = $order->sudah_dibayar + $paymentNotification->gross_amount;


        }

        if ($order->isPaid()) {
            throw new UnprocessableEntityHttpException('Already paid');
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
        try {
            $payment->save(false);
            if ($paymentStatus && $payment) {
                if ($payment->status === Payment::STATUS_SETTLEMENT || $payment->status === Payment::STATUS_SUCCESS) {
                    if ($order instanceof TransaksiProduk) {
                        $order->payment_status = Transaksi::PAYMENT_STATUS_PAID;
                        $order->status = Transaksi::STATUS_CONFIRMED;
                        $order->save(false);
                    } elseif ($order instanceof TransaksiCicilan) {
                        $bayarCicilan->status = Payment::STATUS_SUCCESS;
                        $bayarCicilan->payment_status = Transaksi::PAYMENT_STATUS_PAID;
                        $bayarCicilan->save(false);
                    } elseif ($order instanceof TransaksiPermintaan) {
                        $bayarPermintaan->status = Payment::STATUS_SUCCESS;
                        $bayarPermintaan->payment_status = Transaksi::PAYMENT_STATUS_PAID;
                        $bayarPermintaan->save(false);
                    }
                    $order->save(false);
                    $payment->trigger(Payment::EVENT_PAYMENT_SUCCESS);

                }
            }
            $db->commit();
        } catch (Exception $exception) {
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


    public function actionSelesai()
    {
        $code =  Yii::$app->request->get('order_id');
        $order = null;
        $codeOrder = substr($code, 0, 3);
        if (TransaksiProduk::TRANSAKSI_CODE === $codeOrder) {
            $order = TransaksiProduk::findOne(['code'=>$code]);
            $jenis = TransaksiProduk::TRANSAKSI_PRODUK;
        } elseif (TransaksiCicilan::TRANSAKSI_CODE === $codeOrder) {
            $order = PembayaranCicilan::findOne(['code'=>$code]);
            $jenis = TransaksiCicilan::TRANSAKSI_CICILAN;
        } elseif (PembayaranTransaksiPermintaan::TRANSAKSI_CODE=== $codeOrder) {
            $order = PembayaranTransaksiPermintaan::findOne(['code'=>$code]);
            $jenis = TransaksiPermintaan::TRANSAKSI_PERMINTAAN;
        }

        if ($order->payment_status == Transaksi::PAYMENT_STATUS_UNPAID) {
            return  $this->redirect(['pembayaran/gagal','order_id'=>$code]);
        }

        Yii::$app->session->setFlash('success', 'Thank you for completing the payment process!');

        return  $this->redirect(['transaksi/received','jenis'=>$jenis,'id_transaksi'=>$order->id]);
    }

    public function actionTidakSelesai()
    {
        $code = Yii::$app->request->get('order_id');
        $order = null;
        $codeOrder = substr($code, 0, 3);

        $jenis = null;
        if (TransaksiProduk::TRANSAKSI_CODE === $codeOrder) {
            $order = TransaksiProduk::findOne(['code'=>$code]);
            $jenis = TransaksiProduk::TRANSAKSI_PRODUK;
        } elseif (TransaksiCicilan::TRANSAKSI_CODE === $codeOrder) {
            $order = PembayaranCicilan::findOne(['code'=>$code]);
            $jenis = TransaksiCicilan::TRANSAKSI_CICILAN;
        } elseif (PembayaranTransaksiPermintaan::TRANSAKSI_CODE=== $codeOrder) {
            $order = PembayaranTransaksiPermintaan::findOne(['code'=>$code]);
            $jenis = TransaksiPermintaan::TRANSAKSI_PERMINTAAN;
        }


        Yii::$app->session->setFlash('error', "Sorry, we couldn't process your payment.");

        return $this->redirect(['transaksi/received','id'=>$order->id,'jenis'=>$jenis]);
    }

    public function actionGagal()
    {
        $code = Yii::$app->request->get('order_id');
        $order = null;
        $codeOrder = substr($code, 0, 3);

        $jenis = null;
        if (TransaksiProduk::TRANSAKSI_CODE === $codeOrder) {
            $order = TransaksiProduk::findOne(['code'=>$code]);
            $jenis = TransaksiProduk::TRANSAKSI_PRODUK;
        } elseif (TransaksiCicilan::TRANSAKSI_CODE === $codeOrder) {
            $order = PembayaranCicilan::findOne(['code'=>$code]);
            $jenis = TransaksiCicilan::TRANSAKSI_CICILAN;
        } elseif (PembayaranTransaksiPermintaan::TRANSAKSI_CODE=== $codeOrder) {
            $order = PembayaranTransaksiPermintaan::findOne(['code'=>$code]);
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

    public function actionConfirmPermintaan()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Yii::$app->request->post();

        $user = Yii::$app->user->identity;



        $transaksi = PembayaranTransaksiPermintaan::findOne($data['id']);


        $transactionDetail = [
            'order_id' => $transaksi->code,
            'gross_amount' => $transaksi->nominal
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
                    'price' => $transaksi->nominal,
                    'quantity' => 1,
                    'name' => $transaksi->transaksiPermintaan->permintaan->nama . '(' . $transaksi->jenisString . ')'
                ]

            ],
            'jenis_pembayaran_permintaan'=>$transaksi->jenis
        ];
        $snapToken = Snap::createTransaction($snapPayload);

        if($snapToken){
//            var_dump($snapToken);
            $transaksi->payment_token = $snapToken->token;
            $transaksi->payment_url = $snapToken->redirect_url;
            $transaksi->save(false);
            return ['payment_url' => $transaksi->payment_url,'payment_token'=>$transaksi->payment_token];
        }

        throw new \yii\base\Exception();


    }

    protected function findPermintaan($id)
    {
        $permintaan = PermintaanProduk::findOne($id);
        if (!$permintaan) {
            throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
        }

        return $permintaan;
    }
    protected function findCicilan($id){
        $cicilan = TransaksiCicilan::findOne($id);
        if(!$cicilan){
            throw new NotFoundHttpException();
        }
        return $cicilan;
    }

    protected function findTransaksiPermintaan($id)
    {
        $transaksi = TransaksiPermintaan::findOne(['id_permintaan' => $id]);
        if (!$transaksi) {
            throw new NotFoundHttpException();
        }
        return $transaksi;
    }


    public function actionCicilan()
    {
        $post = Yii::$app->request->post();
        $cicilan = $this->findCicilan($post['id']);
        $user = Yii::$app->user->identity;
        $profilUser = $user->profilUser;

        return $this->render('cicilan', [
           'cicilan'=>$cicilan,
            'user'=>$user,
            'profilUser'=>$profilUser
        ]);
    }
    public function actionConfirmCicilan()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $data = Yii::$app->request->post();

        $user = Yii::$app->user->identity;



        $transaksi = TransaksiCicilan::findOne($data['id']);

        $bayarCicilan = new PembayaranCicilan();
        $bayarCicilan->id_transaksi_cicilan = $transaksi->id;
        $bayarCicilan->jumlah_dibayar = $transaksi->jumlah_cicilan;
        $bayarCicilan->tanggal_pembayaran = Carbon::now()->timestamp;
        $bayarCicilan->code = $bayarCicilan->generateCode();
        $bayarCicilan->payment_status = Transaksi::PAYMENT_STATUS_UNPAID;
        $bayarCicilan->status = Payment::STATUS_PENDING;
        $bayarCicilan->save(false);


        $transactionDetail = [
            'order_id' => $bayarCicilan->code,
            'gross_amount' => $bayarCicilan->jumlah_dibayar
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
                    'id' => $bayarCicilan->id,
                    'price' => $bayarCicilan->jumlah_dibayar,
                    'quantity' => 1,
                    'name' => $transaksi->transaksi->code . '(Cicilan)'
                ]

            ],
        ];
        $snapToken = Snap::createTransaction($snapPayload);

        if($snapToken){
            $bayarCicilan->payment_token = $snapToken->token;
            $bayarCicilan->payment_url = $snapToken->redirect_url;
            $bayarCicilan->save(false);
            return ['payment_url' => $bayarCicilan->payment_url,'payment_token'=>$bayarCicilan->payment_token];
        }

        throw new \yii\base\Exception();


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
                'price' => $transaksi->transaksiCicilan? $transaksi->transaksiCicilan->jumlah_cicilan : $produk->getCost() + ($produk->getCost() * TransaksiProduk::TAX_PERCENTAGE) ,
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

            if($hargaNego = $produk->getNegoPrice()){ // delete harga nego yang sudah disepakati
                $hargaNego->delete();
            }
        }
        return $items;
    }

    private function setupPayment(Transaksi $transkasi, array $items, $isCicilan = false, $cicilan = null, $bayarCicilan = null)
    {
        $user = Yii::$app->user->identity;
        $transactionDetail = [
            'order_id' => $isCicilan? $bayarCicilan->code : $transkasi->getCode(), // kalo cicilan, kodenya TRC, jika tidak Kodenya TRP
            'gross_amount' => $isCicilan ? (int) $cicilan->jumlah_cicilan : $transkasi->grand_total
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
