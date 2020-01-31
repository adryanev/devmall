<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

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
 */
class PermintaanProduk extends \yii\db\ActiveRecord
{
    const PERMINTAAN_DITERIMA = 1;
    const PERMINTAAN_DITOLAK = 0;
    const PERMINTAAN_SELESAI = 9;
    const PERMINTAAN_DIKIRIM = 2;

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
            self::PERMINTAAN_DIKIRIM => 'Permintaan Dikirim',
            self::PERMINTAAN_DITERIMA => 'Permintaan Diterima',
            self::PERMINTAAN_DITOLAK => 'Permintaan Ditolak',
            self::PERMINTAAN_SELESAI => 'Permintaan Selesai'
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
            [['id_booth', 'id_user', 'deadline', 'harga', 'uang_muka', 'status', 'created_at', 'updated_at'], 'integer'],
            [['kriteria', 'keterangan'], 'string'],
            [['progres'], 'number'],
            [['nama'], 'string', 'max' => 255],
            [['id_booth'], 'exist', 'skipOnError' => true, 'targetClass' => Booth::className(), 'targetAttribute' => ['id_booth' => 'id']],
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
            'statusString' => 'Status`'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooth()
    {
        return $this->hasOne(Booth::className(), ['id' => 'id_booth']);
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
    public function getPermintaanProdukDetails()
    {
        return $this->hasMany(PermintaanProdukDetail::className(), ['id_permintaan' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRiwayatPermintaans()
    {
        return $this->hasMany(RiwayatPermintaan::class, ['id_permintaan_produk' => 'id']);
    }
}
