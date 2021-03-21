<?php

namespace common\models;

use Carbon\Carbon;
use oxyaction\behaviors\RelatedPolymorphicBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Exception;

/**
 * This is the model class for table "pembayaran_cicilan".
 *
 * @property int $id
 * @property int $id_transaksi_cicilan
 * @property int $tanggal_pembayaran
 * @property int $jumlah_dibayar
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $code
 * @property string $payment_url
 * @property string $payment_token
 * @property int $payment_status
 *
 * @property TransaksiCicilan $transaksiCicilan
 */
class PembayaranCicilan extends \yii\db\ActiveRecord
{
    const PEMBAYARAN_CICILAN = 'pembayaranCicilan';

    public function getPaymentStatusString(){

        return Transaksi::PAYMENT_STATUSES[$this->payment_status];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pembayaran_cicilan';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'polymorphic'=>[
                'class'=>RelatedPolymorphicBehavior::class,
                'polyRelations'=>[
                    'pembayarans'=>Payment::class
                ],
                'polymorphicType' => self::PEMBAYARAN_CICILAN
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_transaksi_cicilan', 'tanggal_pembayaran', 'jumlah_dibayar', 'status', 'created_at', 'updated_at','payment_status'], 'integer'],
            [['code','payment_url','payment_token'],'string'],
            [['id_transaksi_cicilan'], 'exist', 'skipOnError' => true, 'targetClass' => TransaksiCicilan::className(), 'targetAttribute' => ['id_transaksi_cicilan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_transaksi_cicilan' => 'Id TransaksiProduk Cicilan',
            'tanggal_pembayaran' => 'Tanggal Pembayaran',
            'jumlah_dibayar' => 'Jumlah Dibayar',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiCicilan()
    {
        return $this->hasOne(TransaksiCicilan::className(), ['id' => 'id_transaksi_cicilan']);
    }
    public function generateCode(){
        $now = Carbon::now();

        $code = strtr(TransaksiCicilan::TRANSAKSI_FORMAT, [
            '{transaction_code}'=>TransaksiCicilan::TRANSAKSI_CODE,
            '{transaction_date}'=> $now->isoFormat('YYYYMMDD'),
            '{transaction_type}'=>'cicilan'
        ]);
        $lastOrder = self::find()->where(['like','code',$code])->orderBy('id DESC')->one();
        $lastOrderCode = $lastOrder->code ?? null;
        $transactionCode = $code . '00001';
        if ($lastOrderCode) {
            $lastOrderNumber = str_replace($code, '', $lastOrderCode);
            $nextOrderNumber = sprintf('%05d', (int) $lastOrderNumber +1);
            $transactionCode = $code . $nextOrderNumber;
        }
        return $transactionCode;
    }
}
