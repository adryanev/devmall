<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "riwayat_permintaan".
 *
 * @property int $id
 * @property int $id_permintaan_produk
 * @property int $tanggal
 * @property string $keterangan
 * @property int $created_at
 * @property int $updated_at
 *
 * @property PermintaanProduk $permintaanProduk
 */
class RiwayatPermintaan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'riwayat_permintaan';
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
            [['id_permintaan_produk', 'tanggal', 'created_at', 'updated_at'], 'integer'],
            [['keterangan'], 'string', 'max' => 255],
            [['id_permintaan_produk'], 'exist', 'skipOnError' => true, 'targetClass' => PermintaanProduk::className(), 'targetAttribute' => ['id_permintaan_produk' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_permintaan_produk' => 'Id Permintaan Produk',
            'tanggal' => 'Tanggal',
            'keterangan' => 'Keterangan',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[PermintaanProduk]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPermintaanProduk()
    {
        return $this->hasOne(PermintaanProduk::className(), ['id' => 'id_permintaan_produk']);
    }
}
