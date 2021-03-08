<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "galeri_produk".
 *
 * @property int $id
 * @property int $id_produk
 * @property string $nama_berkas
 * @property string $jenis_berkas
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Produk $produk
 */
class GaleriProduk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'galeri_produk';
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
            [['nama_berkas'], 'required', 'on' => 'create'],
            [['nama_berkas'], 'string', 'max' => 255],
            [['jenis_berkas'], 'string', 'max' => 20],
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
            'nama_berkas' => 'Nama Berkas',
            'jenis_berkas' => 'Jenis Berkas',
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
