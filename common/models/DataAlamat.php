<?php

namespace common\models;

use linslin\yii2\curl;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "galeri_produk".
 *
 * @property int $id
 * @property int $id_produk
 * @property string $nama_berkas
 * @property string $jenis_berkas
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Produk $produk
 */
class DataAlamat extends \yii\db\ActiveRecord
{


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvinsi()
    {
        //Init curl
        $curl = new curl\Curl();

        //get http://example.com/
        $response = $curl->get('https://dev.farizdotid.com/api/daerahindonesia/provinsi');
        $data = json_decode($response);
        $data = $data->provinsi;

        return $data;

    }

    public function getKota($id_provinsi)
    {
        //Init curl
        $curl = new curl\Curl();

        //get http://example.com/
        $response = $curl->get('https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi='.$id_provinsi);
        $data = json_decode($response);
        $data = $data->kota_kabupaten;

        return $data;
    }

    public function getKecamatan($id_kota)
    {
        //Init curl
        $curl = new curl\Curl();

        //get http://example.com/
        $response = $curl->get('https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota='.$id_kota);
        $data = json_decode($response);
        $data = $data->kecamatan;

        return $data;
    }

    public function getKelurahan($id_kecamatan)
    {
        //Init curl
        $curl = new curl\Curl();

        //get http://example.com/
        $response = $curl->get('https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan='.$id_kecamatan);
        $data = json_decode($response);
        $data = $data->kelurahan;

        return $data;
    }


}
