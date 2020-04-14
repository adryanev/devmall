<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "permintaan_produk_detail".
 *
 * @property int $id
 * @property int $id_permintaan
 * @property string $nama_berkas
 * @property string $jenis_berkas
 * @property int $created_at
 * @property int $updated_at
 *
 * @property PermintaanProduk $permintaan
 */
class PermintaanProdukDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'permintaan_produk_detail';
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
            [['id_permintaan', 'created_at', 'updated_at'], 'integer'],
            [['nama_berkas', 'jenis_berkas'], 'string', 'max' => 255],
            [['id_permintaan'], 'exist', 'skipOnError' => true, 'targetClass' => PermintaanProduk::className(), 'targetAttribute' => ['id_permintaan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_permintaan' => 'Id Permintaan',
            'nama_berkas' => 'Nama Berkas',
            'jenis_berkas' => 'Jenis Berkas',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermintaan()
    {
        return $this->hasOne(PermintaanProduk::className(), ['id' => 'id_permintaan']);
    }
}
