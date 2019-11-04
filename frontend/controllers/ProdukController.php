<?php

namespace frontend\controllers;

use common\models\Kategori;
use common\models\Produk;
use frontend\models\ProdukSearch;
use Yii;
use yii\web\NotFoundHttpException;

class ProdukController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $produkSearch = new ProdukSearch();
        $produkDataProvider = $produkSearch->search(Yii::$app->request->queryParams);

        $kategori = Kategori::find()->all();

        return $this->render('index', ['produkDataProvider' => $produkDataProvider,
            'kategori' => $kategori]);
    }

    public function actionSearch()
    {
        $params = Yii::$app->request->queryParams;
        $produkSearch = new ProdukSearch();
        $produkDataProvider = $produkSearch->search($params);

        $kategori = Kategori::find()->all();
        return $this->render('search', compact('produkDataProvider', 'kategori'));
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', ['model' => $model]);
    }

    protected function findModel($id)
    {
        $model = Produk::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
        }

        return $model;

    }

}
