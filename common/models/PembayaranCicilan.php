<?php

namespace common\models;

use oxyaction\behaviors\RelatedPolymorphicBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "pembayaran_cicilan".
 *
 * @property int $id
 * @property int $id_transaksi_cicilan
 * @property int $tanggal_pembayaran
 * @property int $jumlah_dibayar
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property TransaksiCicilan $transaksiCicilan
 */
class PembayaranCicilan extends \yii\db\ActiveRecord
{
    const PEMBAYARAN_CICILAN = 'pembayaranCicilan';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pembayaran_cicilan';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'polymorphic'=>[
                'class'=>RelatedPolymorphicBehavior::class,
                'polyRelations'=>[
                    'pembayarans'=>Pembayaran::class
                ],
                'polymorphicType' => self::PEMBAYARAN_CICILAN
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_transaksi_cicilan', 'tanggal_pembayaran', 'jumlah_dibayar', 'status', 'created_at', 'updated_at'], 'integer'],
            [['id_transaksi_cicilan'], 'exist', 'skipOnError' => true, 'targetClass' => TransaksiCicilan::className(), 'targetAttribute' => ['id_transaksi_cicilan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_transaksi_cicilan' => 'Id TransaksiProduk Cicilan',
            'tanggal_pembayaran' => 'Tanggal Pembayaran',
            'jumlah_dibayar' => 'Jumlah Dibayar',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiCicilan()
    {
        return $this->hasOne(TransaksiCicilan::className(), ['id' => 'id_transaksi_cicilan']);
    }
}
