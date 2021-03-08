<?php

namespace common\models;

use yii\base\InvalidConfigException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

use Yii\db\Query;

use Yii;
use yii\base\Model;

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
 * @property Produk[] $produks
 * @property Promo[] $promos
 * @property Follow[] $followers
 * @property float $avgUlasan
 * @property int $totalUlasan
 * @property string $alamatLengkap
 * @property Produk[] $produkPopuler
 * @property Coin $coin
 */
class Booth extends \yii\db\ActiveRecord
{

    const STATUS_VERIFIED = 1;
    const STATUS_CREATED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booth';
    }

    public function getStatus()
    {
        $status = [
            self::STATUS_VERIFIED => 'Terverifikasi',
            self::STATUS_CREATED => 'Belum diverifikasi',
        ];
        return $status[$this->status];
    }

    public function isVerified()
    {
        return $this->status === self::STATUS_VERIFIED;
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
     * @return ActiveQuery
     */
    public function getCoin()
    {
        return $this->hasOne(Coin::class, ['id'=>'id_booth']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return ActiveQuery
     */
    public function getPromos()
    {
        return $this->hasMany(Promo::className(), ['id_booth' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getFollowers()
    {
        return $this->hasMany(Follow::className(), ['id_booth' => 'id']);
    }

    public function getAvgUlasan()
    {
        $produks = $this->produks;
        $reviews = ArrayHelper::map($produks, 'id', function (/** @var $model Produk */ $model) {
            return $model->nilaiUlasan;
        });

        return round(array_sum($reviews) / max($this->getProduks()->count(), 1), 1);
    }

    /**
     * @return ActiveQuery
     */
    public function getProduks()
    {
        return $this->hasMany(Produk::className(), ['id_booth' => 'id']);
    }

    public function getAllProduks(){

        return $this->hasMany(Produk::className());
    }


    public function getTotalUlasan()
    {
        $produk = $this->produks;
        $totalUlasan = ArrayHelper::map($produk, 'id', function (/** @var $model Produk */ $model) {
            return $model->getUlasans()->count();
        });
        return array_sum($totalUlasan);
    }

    public function getAlamatLengkap()
    {
        $fullAddress = "{$this->alamat1}, {$this->alamat2}, {$this->kelurahan}, {$this->kecamatan}, {$this->kota}, {$this->provinsi}";

        return $fullAddress;
    }

    /**
     * Populer adalah produk yang banyak dibeli dan banyak difavoritkan
     * @throws InvalidConfigException
     */
    public function getProdukPopuler()
    {
        return $this->getProduks()->select(['produk.*', 'count(favorit.id_produk) as jumlah_favorit'])->joinWith('favorits', true, 'right join')->groupBy('produk.id')->orderBy('jumlah_favorit DESC');
    }

    public function getPenjualan($id_booth)
    {
        
    $rows = (new \yii\db\Query())
        ->select(['id_transaksi'])
        ->from('transaksi_detail t_d')
        ->leftJoin('produk prd','t_d.id_produk=prd.id' )
        ->leftJoin('booth bth', 'prd.id_booth=bth.id')
        ->where(['id_booth' => $id_booth])
        ->all();
        
      $rows = count($rows);
    return $rows;
    }
}
