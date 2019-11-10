<?php

namespace frontend\controllers;

use common\models\Booth;
use common\models\Follow;
use frontend\models\BoothSearch;
use frontend\models\ProdukSearch;
use frontend\models\UlasanSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class BoothController extends \yii\web\Controller
{


    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['GET'],
                    'view' => ['GET'],
                    'produk' => ['GET'],
                    'follow' => ['POST'],
                    'unfollow' => ['POST'],
                    'review' => ['GET']
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $modelSearch = new BoothSearch();
        $dataProvider = $modelSearch->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'modelSearch' => $modelSearch,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $produkPopuler = $model->getProdukPopuler();
        $produkPopulerDataProvider = new ActiveDataProvider(['query' => $produkPopuler]);

        return $this->render('view', ['model' => $model, 'produkPopulerDataProvider' => $produkPopulerDataProvider]);
    }

    protected function findModel($id)
    {
        $model = Booth::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
        }

        return $model;
    }

    public function actionProduk()
    {
        $modelSearch = new ProdukSearch();
        $dataProvider = $modelSearch->search(Yii::$app->request->queryParams);

        return $this->render('produk', ['model' => $modelSearch,
            'produkDataProvider' => $dataProvider]);
    }

    public function actionFollow($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);

        }
        $model = $this->findModel($id);
        $user = Yii::$app->user->identity->getId();

        $modelFollow = new Follow();
        $modelFollow->id_pengguna = $user;
        $modelFollow->id_booth = $model->id;
        $modelFollow->notification = true;

        $modelFollow->save(false);
        return $this->redirect(['booth/view', 'id' => $id]);

    }

    public function actionUnfollow($id)
    {

        $user = Yii::$app->user->identity->getId();

        $modelFollow = Follow::findOne(['id_booth' => $id, 'id_pengguna' => $user]);
        $modelFollow->delete();

        return $this->redirect(['booth/view', 'id' => $id]);

    }

    public function actionReview($booth)
    {
        $searchModel = new UlasanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('review', compact('searchModel', 'dataProvider'));
    }

}
