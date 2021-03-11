<?php

namespace common\models;

use common\helpers\PembayaranHelper;
use oxyaction\behaviors\RelatedPolymorphicBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "riwayat_transaksi_permintaan".
 *
 * @property int $id
 * @property int|null $id_transaksi_permintaan
 * @property int|null $nominal
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $jenis
 * @property string|null $jenisString
 * @property string|null $statusString
 * @property string $payment_url
 * @property string $payment_token
 * @property int $payment_status
 *
 * @property TransaksiPermintaan $transaksiPermintaan
 */
class PembayaranTransaksiPermintaan extends ActiveRecord
{
    const PEMBAYARAN_TRANSAKSI_PERMINTAAN = 'pembayaranTransaksiPermintaan';

    const JENIS_UANG_MUKA = 1;
    const JENIS_ANGSURAN = 2;
        const   JENIS = [
            self::JENIS_UANG_MUKA => 'Uang Muka',
            self::JENIS_ANGSURAN => 'Angsuran'
        ];
    /**
     * {@inheritdoc}
     */
        public static function tableName()
        {
            return 'pembayaran_transaksi_permintaan';
        }

        public function getStatusString()
        {
            $status = $this->status;
            $string = PembayaranHelper::STATUS;
            return $string[$status];
        }


        public function getJenisString()
        {
            $jenis = $this->jenis;

            return self::JENIS[$jenis];
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
                'polymorphicType' => self::PEMBAYARAN_TRANSAKSI_PERMINTAAN
            ]
            ];
        }

    /**
     * {@inheritdoc}
     */
        public function rules()
        {
            return [
            [['id_transaksi_permintaan', 'nominal', 'status', 'created_at', 'updated_at','payment_status'], 'integer'],
            [['payment_token','payment_url'], 'string', 'max' => 255],
            [
                ['id_transaksi_permintaan'],
                'exist',
                'skipOnError' => true,
                'targetClass' => TransaksiPermintaan::className(),
                'targetAttribute' => ['id_transaksi_permintaan' => 'id']
            ],
            ];
        }

    /**
     * {@inheritdoc}
     */
        public function attributeLabels()
        {
            return [
            'id' => 'ID',
            'id_transaksi_permintaan' => 'Id TransaksiProduk Permintaan',
            'nominal' => 'Nominal',
            'status' => 'Status',
            'snap_token' => 'Snap Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'jenisString'=>'Jenis TransaksiProduk'
            ];
        }

    /**
     * Gets query for [[TransaksiPermintaan]].
     *
     * @return ActiveQuery
     */
        public function getTransaksiPermintaan()
        {
            return $this->hasOne(TransaksiPermintaan::className(), ['id' => 'id_transaksi_permintaan']);
        }
}
