<?php


namespace frontend\controllers;


use common\models\TransaksiCicilan;
use common\models\TransaksiPermintaan;
use common\models\TransaksiProduk;

class TransaksiController extends \yii\web\Controller
{

    public function actionReceived($jenis,$id_transaksi){

        $order= null;
        if ($jenis == TransaksiProduk::TRANSAKSI_PRODUK) {
            $order = TransaksiProduk::findOne(['id'=>$id_transaksi]);

        } elseif ($jenis == TransaksiCicilan::TRANSAKSI_CICILAN) {
            $order = TransaksiCicilan::findOne(['id'=>$id_transaksi]);

        } elseif ( $jenis == TransaksiPermintaan::TRANSAKSI_PERMINTAAN) {
            $order = TransaksiPermintaan::findOne(['id'=>$id_transaksi]);
        }

        return $this->render('received',['order'=>$order]);

    }
}
