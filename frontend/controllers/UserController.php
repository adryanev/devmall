<?php


namespace frontend\controllers;


use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class UserController extends Controller
{

    public function actionFavorit(){
        $user = $this->findModel();
        $favorit = $user->getFavorits();
        $dataProvider = new ActiveDataProvider(['query' => $favorit]);

        return $this->render('favorit',compact('user','dataProvider'));
    }

    protected function findModel(){
       return Yii::$app->user->identity;
    }

}