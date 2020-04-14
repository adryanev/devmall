<?php

namespace common\models;

use oxyaction\behaviors\RelatedPolymorphicBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "transaksi".
 *
 * @property int $id
 * @property int $id_user
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $jenis_transaksi
 *
 * @property User $user
 * @property TransaksiCicilan[] $transaksiCicilans
 * @property TransaksiDetail[] $transaksiDetails
 */
class TransaksiProduk extends \yii\db\ActiveRecord
{
    const TRANSAKSI_PRODUK = 'TransaksiProduk';

    const STATUS_SUCCESS = 1;
    const STATUS_PENDING = 0;
    const STATUS_FAILED = 3;
    const STATUS_EXPIRED = 4;
    const JENIS_TRANSAKSI_TUNAI = 'tunai';
    const JENIS_TRANSAKSI_CICIL = 'cicil';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksi_produk';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'polymorphic'=>[
                'class'=>RelatedPolymorphicBehavior::class,
                'polyRelations' => [
                    'pembayarans'=> Pembayaran::class
                ],
                'polymorphicType' => self::TRANSAKSI_PRODUK


            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'waktu', 'total', 'status', 'expire', 'created_at', 'updated_at', 'id_booth'], 'integer'],
            [['jenis_transaksi', 'kode_transaksi', 'snap_token'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'waktu' => 'Waktu',
            'total' => 'Total',
            'status' => 'Status',
            'expire' => 'Expire',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'jenis_transaksi' => 'Jenis TransaksiProduk',
            'kode_transaksi' => 'Kode TransaksiProduk',
            'snap_token' => 'Snap Token'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiCicilans()
    {
        return $this->hasMany(TransaksiCicilan::className(), ['id_transaksi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiDetails()
    {
        return $this->hasMany(TransaksiDetail::className(), ['id_transaksi' => 'id']);
    }
}
