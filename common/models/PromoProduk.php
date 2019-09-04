<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "promo_produk".
 *
 * @property int $id
 * @property int $id_promo
 * @property int $id_produk
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Produk $produk
 * @property Promo $promo
 */
class PromoProduk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promo_produk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_promo', 'id_produk', 'created_at', 'updated_at'], 'integer'],
            [['id_produk'], 'exist', 'skipOnError' => true, 'targetClass' => Produk::className(), 'targetAttribute' => ['id_produk' => 'id']],
            [['id_promo'], 'exist', 'skipOnError' => true, 'targetClass' => Promo::className(), 'targetAttribute' => ['id_promo' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_promo' => 'Id Promo',
            'id_produk' => 'Id Produk',
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
    public function getPromo()
    {
        return $this->hasOne(Promo::className(), ['id' => 'id_promo']);
    }
}
