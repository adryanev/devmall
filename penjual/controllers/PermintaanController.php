<?php

namespace penjual\controllers;

use common\models\PermintaanProduk;
use common\models\PermintaanProdukDetail;
use penjual\models\PermintaanSearch;
use yii\web\NotFoundHttpException;
use Yii;
use yii\web\MethodNotAllowedHttpException;

class PermintaanController extends \yii\web\Controller
{


    public function actionIndex()
    {

        $searchModel = new PermintaanSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    public function actionView($id)
    {

        $model = $this->findModel($id);
        if ($model->id_booth !== Yii::$app->user->identity->booth->id) {
            throw new MethodNotAllowedHttpException('Maaf Ini bukan data anda');
        }

        return $this->render('view', compact('model'));
    }

    protected function findModel($id)
    {
        $model = PermintaanProduk::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
        }
        return $model;
    }

    public function actionDownload($id)
    {
        $file = PermintaanProdukDetail::findOne($id);
        if ($file->permintaan->id_booth !== Yii::$app->user->identity->booth->id) {
            throw new MethodNotAllowedHttpException('Maaf anda tidak bisa mengakses halaman ini');
        }

        $path = Yii::getAlias('@permintaanPath/' . $file->nama_berkas);
        return Yii::$app->response->sendFile($path);
    }
}
