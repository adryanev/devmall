<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "transaksi_detail".
 *
 * @property int $id
 * @property int $id_transaksi
 * @property int $id_produk
 * @property int $base_price
 * @property int $created_at
 * @property int $updated_at
 * @property int $tax_amount
 * @property double $tax_percent
 * @property int $discount_amount
 * @property double $discount_percent
 * @property int $bargain_price
 * @property int $sub_total
 *
 * @property Produk $produk
 * @property TransaksiProduk $transaksi
 */
class TransaksiDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksi_detail';
    }

    public function behaviors()
    {
        return [TimestampBehavior::class];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_transaksi', 'id_produk', 'base_price', 'created_at', 'updated_at','base_price','tax_amount','discount_amount','bargain_price','sub_total'], 'integer'],
            [['tax_percent','discount_percent'], 'double'],
            [['id_produk'], 'exist', 'skipOnError' => true, 'targetClass' => Produk::className(), 'targetAttribute' => ['id_produk' => 'id']],
            [['id_transaksi'], 'exist', 'skipOnError' => true, 'targetClass' => TransaksiProduk::className(), 'targetAttribute' => ['id_transaksi' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_transaksi' => 'Id TransaksiProduk',
            'id_produk' => 'Id Produk',
            'base_price' => 'Harga TransaksiProduk',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduk()
    {
        return $this->hasOne(Produk::className(), ['id' => 'id_produk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksi()
    {
        return $this->hasOne(TransaksiProduk::className(), ['id' => 'id_transaksi']);
    }
}
