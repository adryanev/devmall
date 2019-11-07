<?php

namespace frontend\controllers;

use common\models\Booth;
use frontend\models\BoothSearch;
use Yii;
use yii\web\NotFoundHttpException;

class BoothController extends \yii\web\Controller
{
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

        return $this->render('view', ['model' => $model]);
    }

    protected function findModel($id)
    {
        $model = Booth::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
        }

        return $model;
    }

}
