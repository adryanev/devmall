<?php

namespace common\models;

use Carbon\Carbon;
use oxyaction\behaviors\RelatedPolymorphicBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Exception;

/**
 * This is the model class for table "transaksi".
 *
 * @property int $id
 * @property int $id_user
 * @property int $created_at
 * @property int $updated_at
 * @property int $promo
 * @property string $jenis_transaksi

 *
 * @property User $user
 * @property TransaksiCicilan $transaksiCicilan
 * @property TransaksiDetail[] $transaksiDetails
 * @property Promo $promoProduk
 */
class TransaksiProduk extends Transaksi
{
    const TRANSAKSI_PRODUK = 'transaksiProduk';


    const JENIS_TRANSAKSI_TUNAI = 'tunai';
    const JENIS_TRANSAKSI_CICIL = 'cicil';

    const TAX_PERCENTAGE = 0.1;
    public const TRANSAKSI_CODE = 'TRP';

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
                    'pembayarans'=> Payment::class
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
            [['id_user', 'waktu', 'total', 'status', 'expire', 'created_at', 'updated_at',], 'integer'],
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
    public function getPromoProduk()
    {
        return $this->hasOne(Promo::className(), ['id' => 'promo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiCicilan()
    {
        return $this->hasOne(TransaksiCicilan::className(), ['id_transaksi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiDetails()
    {
        return $this->hasMany(TransaksiDetail::className(), ['id_transaksi' => 'id']);
    }

    public function getCode()
    {
        return $this->code;
    }

    public function isPaid()
    {
        return $this->payment_status === self::PAYMENT_STATUS_PAID;
    }
}
