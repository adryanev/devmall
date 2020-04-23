<?php

namespace common\models;

/**
 * This is the model class for table "pembayaran".
 *
 * @property int $id
 * @property string|null $kode_pembayaran
 * @property int|null $external_id
 * @property string|null $type
 * @property int|null $jenis_pembayaran
 * @property int|null $nominal
 * @property int|null $status
 * @property int|null $expire
 * @property int|null $waktu
 * @property string|null $snap_token
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property TransaksiProduk $transaksiProduk
 * @property TransaksiCicilan $transaksiCicilan
 * @property PembayaranTransaksiPermintaan $transkasiPermintaan
 */
class Pembayaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pembayaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['external_id', 'jenis_pembayaran', 'nominal', 'status', 'expire', 'waktu', 'created_at', 'updated_at'], 'integer'],
            [['kode_pembayaran', 'type', 'snap_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode_pembayaran' => 'Kode Pembayaran',
            'external_id' => 'External ID',
            'type' => 'Type',
            'jenis_pembayaran' => 'Jenis Pembayaran',
            'nominal' => 'Nominal',
            'status' => 'Status',
            'expire' => 'Expire',
            'waktu' => 'Waktu',
            'snap_token' => 'Snap Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiProduk(){
        return $this->hasOne(TransaksiProduk::class,['id'=>'external_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiCicilan(){
        return $this->hasOne(TransaksiCicilan::class,['id'=>'external_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiPermintaan(){
        return $this->hasOne(PembayaranTransaksiPermintaan::class,['id'=>'external_id']);
    }

    public function savePembayaranProduk(){
        $transaksi = $this->transaksiProduk;
        $transaksi->status = $this->status;

        $detailTransaksi = $transaksi->transaksiDetails;
        foreach ($detailTransaksi as $detail){
            $booth = $detail->produk->booth;
            $coin = $booth->coin;
            if($detail->is_promo) $coin->saldo += $detail->produk->hargaDiskon;
            else $coin->saldo += $detail->produk->harga;
            $coin->save(false);
        }

        return $transaksi->save(false);

    }

    public function savePembayaranCicilan(){
        $transaksi = $this->transaksiCicilan;
        $pembayaranCicilan = new PembayaranCicilan();
        $pembayaranCicilan->status = $this->status;
        $pembayaranCicilan->tanggal_pembayaran = $this->waktu;
        $pembayaranCicilan->jumlah_dibayar = $this->nominal;
        $pembayaranCicilan->id_transaksi_cicilan = $transaksi->id;
        $transaksi->updateStatus();
        return $pembayaranCicilan->save(false);



    }

    public function savePembayaranPermintaan(){

    }
}
