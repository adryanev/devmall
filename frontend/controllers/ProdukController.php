<?php

namespace frontend\controllers;

use common\models\Kategori;
use common\models\Produk;
use common\models\Ulasan;
use frontend\models\forms\nego\NegoForm;
use frontend\models\ProdukSearch;
use frontend\models\UlasanSearch;
use Yii;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;

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
        $modelUlasan = new Ulasan();

        $modelNego = new NegoForm($id);


        if (!Yii::$app->user->isGuest) {
            $modelUlasan->id_produk = $id;
            $modelUlasan->id_user = Yii::$app->user->identity->getId();
        }


        $ulasanSearch = new UlasanSearch();
        $ulasanSearch->id_produk = $id;
        $ulasanDataProvider = $ulasanSearch->search(Yii::$app->request->queryParams);

        if ($modelUlasan->load(Yii::$app->request->post())) {
            $modelUlasan->save();
            Yii::$app->session->setFlash('success', [
                'type' => 'success',
                'icon' => 'fas fa-check',
                'message' => 'Ulasan anda berhasil kami terima.',
                'title' => 'Berhasil mengirim Ulasan',
            ]);

            return $this->redirect(Url::current());
        }

        if (Yii::$app->request->isAjax && $modelNego->load(Yii::$app->request->post())) {

            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($modelNego);
        }
        if ($modelNego->load(Yii::$app->request->post())) {
            if (!$modelNego->simpanHarga()) {
                Yii::$app->session->setFlash('warning', [
                    'type' => 'warning',
                    'icon' => 'fas fa-warning',
                    'message' => 'Terjadi kesalahan saat menyimpan harga nego',
                    'title' => 'Ups, terjadi kesalahan.'
                ]);
                return $this->redirect(Url::current());
            }
            Yii::$app->session->setFlash('success', [
                'type' => 'success',
                'icon' => 'fas fa-check',
                'message' => 'Nego Berhasil disimpan.',
                'title' => 'Nego',
            ]);
            return $this->redirect(Url::current());

        }

        return $this->render('view', compact('model', 'ulasanSearch', 'modelUlasan', 'ulasanDataProvider', 'modelNego'));
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
