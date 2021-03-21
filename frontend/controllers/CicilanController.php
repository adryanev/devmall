<?php


namespace frontend\controllers;


use common\models\Transaksi;
use common\models\TransaksiCicilan;
use yii\data\ActiveDataProvider;

class CicilanController extends \yii\web\Controller
{
    public function actionIndex(){
        $user = \Yii::$app->user->identity;
        $dataProvider = new ActiveDataProvider(['query' => TransaksiCicilan::find()->joinWith('transaksi')->onCondition(['transaksi_produk.id_user'=>$user->id,'transaksi_produk.payment_status'=>Transaksi::PAYMENT_STATUS_UNPAID])]);
        return $this->render('index',compact('dataProvider'));
    }

    public function actionView($id){
        $model = TransaksiCicilan::findOne($id);
        return $this->render('view',compact('model'));
    }
}
