<?php

namespace common\models;

use common\helpers\PembayaranHelper;
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
 * @property TransaksiProduk $transaksi
 */
class TransaksiCicilan extends Transaksi
{

    const TRANSAKSI_CODE = 'TRC';
    const TRANSAKSI_CICILAN = 'transaksiCicilan';
    const STATUS_LUNAS = 1;
    const STATUS_ONGOING = 0;

    const STATUS = [
        self::STATUS_ONGOING => 'Berlangsung',self::STATUS_LUNAS => 'Lunas'];
    public function getStatusString(){
        return self::STATUS[$this->status];
    }
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
            [['id_transaksi'], 'exist', 'skipOnError' => true, 'targetClass' => TransaksiProduk::className(), 'targetAttribute' => ['id_transaksi' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_transaksi' => 'Id TransaksiProduk',
            'banyak_cicilan' => 'Banyak Cicilan',
            'jumlah_cicilan' => 'Jumlah Cicilan',
            'tanggal_jatuh_tempo' => 'Tanggal Jatuh Tempo',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'statusString'=>'Status'
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
        return $this->hasOne(TransaksiProduk::className(), ['id' => 'id_transaksi']);
    }

    public function updateStatus(){
        $pembayaran = $this->pembayaranCicilans;
        $sum = 0;
        foreach ($pembayaran as $bayar){
            $sum += $bayar->jumlah_dibayar;
        }
        if($sum >= $this->transaksi->grand_total){
            $this->status = self::STATUS_LUNAS;
            $this->transaksi->payment_status = Transaksi::PAYMENT_STATUS_PAID;
        }
        else {
            $this->status = self::STATUS_ONGOING;
        }

        return $this->save(false) && $this->transaksi->save(false);
    }

    public function getCode()
    {
        return $this->code;
    }

    public function isPaid()
    {
        return $this->transaksi->status === self::PAYMENT_STATUS_PAID;
    }
}
