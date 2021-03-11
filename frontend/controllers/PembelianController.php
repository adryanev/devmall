<?php


namespace frontend\controllers;


use common\models\PermintaanProduk;
use common\models\Transaksi;
use common\models\TransaksiCicilan;
use common\models\TransaksiPermintaan;
use common\models\TransaksiProduk;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class PembelianController extends Controller
{

    public function actionIndex(){

        $userID = \Yii::$app->user->id;
        $transaksiProduk = new ActiveDataProvider(['query' => TransaksiProduk::find()->where(['id_user'=>$userID])]);
        return $this->render('index',['transaksiProduk'=>$transaksiProduk]);
    }

    public function actionView($id){
        $model = TransaksiProduk::findOne($id);

        return $this->render('view',['model'=>$model]);
    }
}
