<?php


namespace penjual\controllers;


use common\models\Transaksi;
use common\models\TransaksiDetail;
use common\models\TransaksiProduk;
use yii\data\ActiveDataProvider;

class TransaksiController extends \yii\web\Controller
{


    public function actionMasuk(){
        $booth = \Yii::$app->user->identity->booth;
        $transaksiDataProvider = new ActiveDataProvider(['query' => TransaksiProduk::find()->joinWith('transaksiDetails.produk')->where(['produk.id_booth'=>$booth->id])->orderBy('order_date DESC')]);
        return $this->render('masuk',['transaksiDataProvider'=>$transaksiDataProvider,'booth'=>$booth]);
    }

    public function actionView($id){
        $model = TransaksiProduk::findOne($id);
        return $this->render('view',['model'=>$model]);
    }
}
