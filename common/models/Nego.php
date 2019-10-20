<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "nego".
 *
 * @property int $id
 * @property int $id_produk
 * @property int $harga_satu
 * @property int $harga_dua
 * @property int $harga_tiga
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Produk $produk
 */
class Nego extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nego';
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
            [['id_produk', 'harga_satu', 'harga_dua', 'harga_tiga', 'created_at', 'updated_at'], 'integer'],
            [['id_produk'], 'unique'],
            [['id_produk'], 'exist', 'skipOnError' => true, 'targetClass' => Produk::className(), 'targetAttribute' => ['id_produk' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_produk' => 'Id Produk',
            'harga_satu' => 'Harga Satu',
            'harga_dua' => 'Harga Dua',
            'harga_tiga' => 'Harga Tiga',
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
}
