<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "transaksi_cicilan".
 *
 * @property int $id
 * @property int $id_transaksi
 * @property int $banyak_cicilan
 * @property int $jumlah_cicilan
 * @property string $tanggal_jatuh_tempo
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property PembayaranCicilan[] $pembayaranCicilans
 * @property Transaksi $transaksi
 */
class TransaksiCicilan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksi_cicilan';
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
            [['id_transaksi', 'banyak_cicilan', 'jumlah_cicilan', 'status', 'created_at', 'updated_at'], 'integer'],
            [['tanggal_jatuh_tempo'], 'safe'],
            [['id_transaksi'], 'exist', 'skipOnError' => true, 'targetClass' => Transaksi::className(), 'targetAttribute' => ['id_transaksi' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_transaksi' => 'Id Transaksi',
            'banyak_cicilan' => 'Banyak Cicilan',
            'jumlah_cicilan' => 'Jumlah Cicilan',
            'tanggal_jatuh_tempo' => 'Tanggal Jatuh Tempo',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPembayaranCicilans()
    {
        return $this->hasMany(PembayaranCicilan::className(), ['id_transaksi_cicilan' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksi()
    {
        return $this->hasOne(Transaksi::className(), ['id' => 'id_transaksi']);
    }
}
