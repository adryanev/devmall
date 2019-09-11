<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "booth".
 *
 * @property int $id
 * @property int $id_user
 * @property string $nama
 * @property string $alamat1
 * @property string $alamat2
 * @property string $kelurahan
 * @property string $kecamatan
 * @property string $kota
 * @property string $provinsi
 * @property string $banner
 * @property string $avatar
 * @property string $deskripsi
 * @property string $email
 * @property string $nomor_telepon
 * @property double $latitude
 * @property double $longitude
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 * @property Produk $produk
 * @property Promo[] $promos
 */
class Booth extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booth';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'status', 'created_at', 'updated_at'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['nama', 'alamat1', 'alamat2', 'banner', 'avatar', 'email'], 'string', 'max' => 100],
            [['kelurahan', 'kecamatan', 'kota', 'provinsi'], 'string', 'max' => 50],
            [['deskripsi'], 'string', 'max' => 250],
            [['nomor_telepon'], 'string', 'max' => 20],
            [['id_user'], 'unique'],
            [['nama'], 'unique'],
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
            'nama' => 'Nama',
            'alamat1' => 'Alamat1',
            'alamat2' => 'Alamat2',
            'kelurahan' => 'Kelurahan',
            'kecamatan' => 'Kecamatan',
            'kota' => 'Kota',
            'provinsi' => 'Provinsi',
            'banner' => 'Banner',
            'avatar' => 'Avatar',
            'deskripsi' => 'Deskripsi',
            'email' => 'Email',
            'nomor_telepon' => 'Nomor Telepon',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
    public function getProduk()
    {
        return $this->hasOne(Produk::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromos()
    {
        return $this->hasMany(Promo::className(), ['id_booth' => 'id']);
    }
}
