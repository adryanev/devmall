<?php

namespace common\models;

use Carbon\Carbon;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\Exception;
use yii\db\Query;

/**
 * This is the model class for table "pembayaran".
 *
 * @property int $id
 * @property string|null $kode_pembayaran
 * @property int|null $external_id
 * @property string|null $type
 * @property int|null $jenis_pembayaran
 * @property int|null $nominal
 * @property int|null $status
 * @property int|null $expire
 * @property int|null $waktu
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $payloads
 * @property string|null $token
 * @property string|null $va_number
 * @property string|null $vendor_name
 * @property string|null $biller_code
 * @property string|null $bill_key
 *
 * @property TransaksiProduk $transaksiProduk
 * @property TransaksiCicilan $transaksiCicilan
 * @property TransaksiPermintaan $transaksiPermintaan
 * @property PembayaranTransaksiPermintaan $transkasiPermintaan
 */
class Payment extends \yii\db\ActiveRecord
{

    const PAYMENT_CHANNELS = ['credit_card','mandiri_clickpay','cimb_clicks','bca_klikbca','bca_klikpay','bri_epay','echannel','permata_va','bca_va','bni_va','other_va','gopay','indomaret',
        'danamon_online','akulaku','kioson','echannel'];

    const EXPIRY_DURATION = 1;
    const EXPIRY_UNIT = 'days';

    const STATUS_SUCCESS = 1;
    const STATUS_PENDING = 2;
    const STATUS_DENIED = 3;
    const STATUS_EXPIRED = 4;
    const STATUS_CHALLENGED = 5;
    const STATUS_SETTLEMENT = 6;
    const STATUS_CANCELED = 7;

    const JENIS_PRODUK = 1;
    const JENIS_PERMINTAAN = 2;
    const JENIS_CICILAN = 3;


    const JENIS = [
        self::JENIS_PRODUK => 'Produk',
        self::JENIS_PERMINTAAN => 'Permintaan',
        self::JENIS_CICILAN => 'Cicilan'
    ];

    const PAYMENT_CODE = 'PAY';

    const STATUS = [
        self::STATUS_PENDING => 'Pending',
        self::STATUS_SUCCESS => 'Success',
        self::STATUS_EXPIRED =>'Expired',
        self::STATUS_CHALLENGED =>'Challenged by FDS',
        self::STATUS_DENIED =>'Denied',
        self::STATUS_SETTLEMENT =>'Settlement',
        self::STATUS_CANCELED =>'Canceled',
    ];

    const TYPE_TRANSAKSI_PRODUK = TransaksiProduk::class;
    const TYPE_TRANSAKSI_CICILAN = TransaksiCicilan::class;
    const TYPE_TRANSAKSI_PERMINTAAN = TransaksiPermintaan::class;

    private const PAYMENT_FORMAT = '{payment_code}/devmall/{payment_date}/{payment_type}/';
    public const EVENT_PAYMENT_SUCCESS = 'paymentSuccess';

    public function init()
    {
        $this->on(self::EVENT_PAYMENT_SUCCESS,[$this,'sendCoin']);
        parent::init();
    }

    public function sendCoin($event){

        $payment = $event->sender;
        $transaksi = $payment->type;
        $modelTransaksi =  call_user_func($transaksi.'::findOne',['id'=>$payment->external_id]);
        if($transaksi === TransaksiProduk::class){
            $detail =$modelTransaksi->transaksiDetails;
            foreach ($detail as $item){
                $coin = Coin::findOne(['id_booth'=>$item->produk->id_booth]);
                $ledger = new CoinLedger();
                $currentSaldo = $coin->saldo;
                $nominal = $item->sub_total;
                $currentSaldo +=$this->nominal;
                $coin->saldo = $currentSaldo;
                $ledger->id_coin = $coin->id;
                $ledger->type = CoinLedger::TYPE_IN;
                $ledger->amount = $nominal;

                $coin->save(false);
                $ledger->save(false);
            }
        } elseif ($transaksi === TransaksiCicilan::class) {
//            $riwayat = $modelTransaksi->getPembayaranCicilans()->andWhere(['status'=>Payment::STATUS_SUCCESS])->orderBy('id DESC')->one();
            $detail =$modelTransaksi->transaksi->transaksiDetails;
            foreach ($detail as $item){
                $coin = Coin::findOne(['id_booth'=>$item->produk->id_booth]);
                $ledger = new CoinLedger();
                $currentSaldo = $coin->saldo;
                $nominal = (int) ceil($item->sub_total/$modelTransaksi->jumlah_cicilan);
                $currentSaldo +=$this->nominal;
                $coin->saldo = $currentSaldo;
                $ledger->id_coin = $coin->id;
                $ledger->type = CoinLedger::TYPE_IN;
                $ledger->amount = $nominal;

                $coin->save(false);
                $ledger->save(false);
            }
        }
        elseif ($transaksi === TransaksiPermintaan::class){
            $coin  = $modelTransaksi->permintaan->booth->coin;
            $ledger = new CoinLedger();
            $currentSaldo = $coin->saldo;
            $nominal = $payment->nominal;
            $currentSaldo +=$this->nominal;
            $coin->saldo = $currentSaldo;
            $ledger->id_coin = $coin->id;
            $ledger->type = CoinLedger::TYPE_IN;
            $ledger->amount = $nominal;

            $coin->save(false);
            $ledger->save(false);


        }

    }


    public static function generateKodePembayaran($type)
    {

        $now = Carbon::now();

        $code = strtr(self::PAYMENT_FORMAT, [
            '{payment_code}'=>self::PAYMENT_CODE,
            '{payment_date}'=> $now->isoFormat('YYYYMMDDkkmmss'),
            '{payment_type}'=>self::JENIS[$type]
        ]);
        $lastOrder = self::find()->where(['like','kode_pembayaran',$code])->orderBy('id DESC')->one();
        $lastOrderCode = $lastOrder->kode_pembayaran ?? null;
        $paymentCode = $code . '00001';
        if ($lastOrderCode) {
            $lastOrderNumber = str_replace($code, '', $lastOrderCode);
            $nextOrderNumber = sprintf('%05d', (int) $lastOrderNumber +1);
            $paymentCode = $code . $nextOrderNumber;
        }

        if (self::isOrderCodeExist($paymentCode)) {
            throw new Exception('kode pembayaran exists');
        }

        return $paymentCode;
    }

    /**
     * Check if the generated order code is exists
     *
     * @param string $orderCode order code
     *
     * @return boolean
     */
    private static function isOrderCodeExist($orderCode)
    {
        return self::find()->where(['kode_pembayaran'=>$orderCode])->exists();
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments';
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['external_id', 'jenis_pembayaran', 'nominal', 'status', 'expire', 'waktu', 'created_at', 'updated_at'], 'integer'],
            [['kode_pembayaran', 'type', 'payloads','token','va_number','vendor_name','bill_key','biller_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode_pembayaran' => 'Kode Pembayaran',
            'external_id' => 'External ID',
            'type' => 'Type',
            'jenis_pembayaran' => 'Jenis Pembayaran',
            'nominal' => 'Nominal',
            'status' => 'Status',
            'expire' => 'Expire',
            'waktu' => 'Waktu',
            'snap_token' => 'Snap Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getTransaksiProduk()
    {
        return $this->hasOne(TransaksiProduk::class, ['id'=>'external_id'])->andOnCondition(['type'=>self::TYPE_TRANSAKSI_PRODUK]);
    }

    /**
     * @return ActiveQuery
     */
    public function getTransaksiCicilan()
    {
        return $this->hasOne(TransaksiCicilan::class, ['id'=>'external_id'])->andOnCondition(['type'=>self::TYPE_TRANSAKSI_CICILAN]);
    }

    /**
     * @return ActiveQuery
     */
    public function getTransaksiPermintaan()
    {
        return $this->hasOne(PembayaranTransaksiPermintaan::class, ['id'=>'external_id'])->andOnCondition(['type'=>self::TYPE_TRANSAKSI_PERMINTAAN]);
    }

    public function savePembayaranProduk()
    {
        $transaksi = $this->transaksiProduk;
        $transaksi->status = $this->status;

        $detailTransaksi = $transaksi->transaksiDetails;
        foreach ($detailTransaksi as $detail) {
            $booth = $detail->produk->booth;
            $coin = $booth->coin;
            if ($detail->is_promo) {
                $coin->saldo += $detail->produk->hargaDiskon;
            } else {
                $coin->saldo += $detail->produk->harga;
            }
            $coin->save(false);
        }

        return $transaksi->save(false);
    }

    public function savePembayaranCicilan()
    {
        $transaksi = $this->transaksiCicilan;
        $pembayaranCicilan = new PembayaranCicilan();
        $pembayaranCicilan->status = $this->status;
        $pembayaranCicilan->tanggal_pembayaran = $this->waktu;
        $pembayaranCicilan->jumlah_dibayar = $this->nominal;
        $pembayaranCicilan->id_transaksi_cicilan = $transaksi->id;
        $transaksi->updateStatus();
        return $pembayaranCicilan->save(false);
    }

    public function savePembayaranPermintaan()
    {
    }
}
