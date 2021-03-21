<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "permintaan_produk".
 *
 * @property int $id
 * @property int $id_booth
 * @property int $id_user
 * @property string $nama
 * @property string $kriteria
 * @property int $deadline
 * @property int $harga
 * @property int $uang_muka
 * @property double $progres
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $keterangan
 * @property string $statusString
 *
 * @property Booth $booth
 * @property User $user
 * @property PermintaanProdukDetail[] $permintaanProdukDetails
 * @property RiwayatPermintaan[] $riwayatPermintaans
 * @property TransaksiPermintaan $transaksiPermintaan
 */
class PermintaanProduk extends ActiveRecord
{
    const STATUS_DITERIMA = 1;
    const STATUS_DITOLAK = 0;
    const STATUS_SELESAI = 9;
    const STATUS_DIKIRIM = 2;
    const STATUS_DIKERJAKAN = 5;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'permintaan_produk';
    }

    public function getStatusString()
    {
        $string = [
            self::STATUS_DIKIRIM => 'Permintaan Dikirim',
            self::STATUS_DITERIMA => 'Permintaan Diterima',
            self::STATUS_DITOLAK => 'Permintaan Ditolak',
            self::STATUS_SELESAI => 'Permintaan Selesai',
            self::STATUS_DIKERJAKAN => 'Permintaan Dikerjakan',
        ];


        return $string[$this->status];
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
            [
                ['id_booth', 'id_user', 'deadline', 'harga', 'uang_muka', 'status', 'created_at', 'updated_at'],
                'integer'
            ],
            [['kriteria', 'keterangan'], 'string'],
            [['progres'], 'number'],
            [['nama'], 'string', 'max' => 255],
            [
                ['id_booth'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Booth::className(),
                'targetAttribute' => ['id_booth' => 'id']
            ],
            [
                ['id_user'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['id_user' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_booth' => 'Id Booth',
            'id_user' => 'Id User',
            'nama' => 'Nama Produk',
            'kriteria' => 'Kriteria Produk',
            'deadline' => 'Batas Pengerjaan',
            'harga' => 'Harga',
            'uang_muka' => 'Uang Muka',
            'progres' => 'Progres',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'keterangan' => 'Keterangan',
            'statusString' => 'Status'
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getBooth()
    {
        return $this->hasOne(Booth::className(), ['id' => 'id_booth']);
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
    public function getPermintaanProdukDetails()
    {
        return $this->hasMany(PermintaanProdukDetail::className(), ['id_permintaan' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getRiwayatPermintaans()
    {
        return $this->hasMany(RiwayatPermintaan::class, ['id_permintaan_produk' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getTransaksiPermintaan()
    {
        return $this->hasOne(TransaksiPermintaan::class, ['id_permintaan' => 'id']);
    }

}
