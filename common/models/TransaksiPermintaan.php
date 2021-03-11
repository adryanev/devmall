<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "transaksi_permintaan".
 *
 * @property int $id
 * @property int|null $id_permintaan
 * @property int|null $sudah_dibayar
 * @property int|null $belum_dibayar
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property PembayaranTransaksiPermintaan[] $transaksiBelumDibayar
 *
 * @property PembayaranTransaksiPermintaan[] $riwayatTransaksiPermintaans
 * @property PermintaanProduk $permintaan
 */
class TransaksiPermintaan extends Transaksi
{
    public const TRANSAKSI_CODE = 'TRM';
    public const TRANSAKSI_PERMINTAAN = 'transaksiPermintaan';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksi_permintaan';
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
            [['id_permintaan', 'sudah_dibayar', 'belum_dibayar', 'status', 'created_at', 'updated_at'], 'integer'],
            [
                ['id_permintaan'],
                'exist',
                'skipOnError' => true,
                'targetClass' => PermintaanProduk::className(),
                'targetAttribute' => ['id_permintaan' => 'id']
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
            'id_permintaan' => 'Id Permintaan',
            'sudah_dibayar' => 'Sudah Dibayar',
            'belum_dibayar' => 'Belum Dibayar',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Permintaan]].
     *
     * @return ActiveQuery
     */
    public function getPermintaan()
    {
        return $this->hasOne(PermintaanProduk::className(), ['id' => 'id_permintaan']);
    }

    public function getTransaksiBelumDibayar()
    {

        return $this->getRiwayatTransaksiPermintaans()->andWhere(['payment_status' => Payment::STATUS_PENDING]);
    }

    /**
     * Gets query for [[RiwayatTransaksiPermintaans]].
     *
     * @return ActiveQuery
     */
    public function getRiwayatTransaksiPermintaans()
    {
        return $this->hasMany(PembayaranTransaksiPermintaan::className(), ['id_transaksi_permintaan' => 'id']);
    }

    public function getCode()
    {
        // TODO: Implement getCode() method.
    }

    public function isPaid()
    {
        // TODO: Implement isPaid() method.
    }
}
