<?php


namespace penjual\controllers;


use yii\data\ActiveDataProvider;

class CoinController extends \yii\web\Controller
{
    public function actionIndex(){
        $booth = \Yii::$app->user->identity->booth;
        $coin = $booth->coin;
        $ledger = new ActiveDataProvider(['query' => $coin->getLedger()]);

        return $this->render('index',compact('booth','coin','ledger'));
    }

}
