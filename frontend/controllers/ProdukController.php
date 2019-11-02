<?php

namespace frontend\controllers;

use frontend\models\ProdukSearch;

class ProdukController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSearch()
    {
        $params = \Yii::$app->request->getQueryParams();
        $produkSearch = new ProdukSearch();
        $produkDataProvider = $produkSearch->search($params);


        return $this->render('search', compact('produkDataProvider'));
    }

}
