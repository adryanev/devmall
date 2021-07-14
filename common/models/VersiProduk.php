<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "versi_produk".
 *
 * @property int $id
 * @property int|null $id_produk
 * @property string|null $link_lama
 * @property string|null $link_baru
 * @property string|null $catatan_perubahan
 * @property string|null $cara_instalasi
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Produk $produk
 */
class VersiProduk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'versi_produk';
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
            [['id_produk', 'created_at', 'updated_at'], 'integer'],
            [['catatan_perubahan', 'cara_instalasi'], 'string'],
            [['link_lama', 'link_baru'], 'string', 'max' => 255],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Produk::className(), 'targetAttribute' => ['id' => 'id']],
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
            'link_lama' => 'Link Lama',
            'link_baru' => 'Link Baru',
            'catatan_perubahan' => 'Catatan Perubahan',
            'cara_instalasi' => 'Cara Instalasi',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduk()
    {
        return $this->hasOne(Produk::className(), ['id' => 'id_produk']);
    }
}
