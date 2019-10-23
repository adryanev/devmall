<?php

namespace penjual\controllers;

use Carbon\Carbon;
use common\models\Booth;
use common\models\GaleriProduk;
use common\models\Kategori;
use common\models\Nego;
use common\models\Produk;
use penjual\models\ProdukSearch;
use Yii;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;


/**
 * ProdukController implements the CRUD actions for Produk model.
 */
class ProdukController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Produk models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProdukSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Produk model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $gambar = $model->galeriProduks;
        return $this->render('view', [
            'model' => $model,
            'gambar' => $gambar
        ]);
    }

    /**
     * Finds the Produk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Produk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Produk::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new Produk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Produk();
        $negoModel = new Nego();
        $galeriModel = new GaleriProduk();
        $dataGaleri = null;
        /** @var $booth Booth */
        $booth = Yii::$app->user->identity->booth;
        if ($model->load(Yii::$app->request->post()) && $negoModel->load(Yii::$app->request->post()) && $galeriModel->load(Yii::$app->request->post())) {

            $manual = UploadedFile::getInstance($model, 'manual');
            $galeri = UploadedFile::getInstances($galeriModel, 'nama_berkas');
            $transaction = Yii::$app->db->beginTransaction();

            $model->id_booth = $booth->id;
            if (!empty($manual)) {
                $timestamp = Carbon::now()->timestamp;
                $filename = $timestamp . '-' . $manual->baseName . '.' . $manual->extension;
                $model->manual = $filename;
                $manual->saveAs(Yii::getAlias("@penjual/web/upload/produk/") . $filename);


            }
            if (!$model->save(false)) {
                throw new Exception('Gagal menyimpan produk');
            }
            if ($model->nego) {
                $nego = new Nego();
                $nego->setAttributes($negoModel->attributes);
                $nego->id_produk = $model->id;;
                $nego->save(false);
            }

            if (!empty($galeri)) {
                foreach ($galeri as $file) {
                    $timestamp = Carbon::now()->timestamp;
                    $filename = $timestamp . '-' . $file->baseName . '.' . $file->extension;
                    $galeri = new GaleriProduk();
                    $galeri->id_produk = $model->id;
                    $galeri->nama_berkas = $filename;
                    $galeri->jenis_berkas = $file->extension;
                    $galeri->save(false);
                    $file->saveAs(Yii::getAlias("@penjual/web/upload/produk/") . $filename);

                }
            }
            try {
                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }


            Yii::$app->session->setFlash('success', 'Berhasil menambahkan Produk.');

            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
            'negoModel' => $negoModel,
            'galeriModel' => $galeriModel,
            'dataGaleri' => $dataGaleri

        ]);
    }

    /**
     * Updates an existing Produk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = Produk::findOne($id);
        $negoModel = $model->nego0;
        $galeriModel = new GaleriProduk();
        $dataGaleri = GaleriProduk::find()->where(['id_produk' => $model->id])->all();

        if ($model->load(Yii::$app->request->post())) {
            $update = $model->update();
            Yii::$app->session->setFlash('success', 'Berhasil mengubah Produk.');

            return $this->redirect(['view', 'id' => $update->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'negoModel' => $negoModel,
            'galeriModel' => $galeriModel,
            'dataGaleri' => $dataGaleri

        ]);
    }

    /**
     * Deletes an existing Produk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', 'Berhasil menghapus Produk.');

        return $this->redirect(['index']);
    }

    public function actionKategoriList($query)
    {
        $models = Kategori::find()->all();
        $items = [];

        foreach ($models as $model) {
            $items[] = ['name' => $model->nama];
        }

        Yii::$app->response->format = Response::FORMAT_JSON;

        return $items;

    }

    public function actionHapusManual($id)
    {
        if (Yii::$app->request->isPost) {

            $data = Yii::$app->request->post();

            $id = $data['id'];
            $produk = $this->findModel($id);
            $path = Yii::getAlias('@produkPath');
            $deleteDokumen = FileHelper::unlink($path . "/" . $produk->manual);
            if ($deleteDokumen) {
                $produk->manual = null;
                Yii::$app->session->setFlash('success', 'Berhasil menghapus dokumen led');
                return $this->redirect(['produk/update', 'id' => $id]);

            }
            Yii::$app->session->setFlash('success', 'Gagal menghapus dokumen led');
            return $this->redirect(['produk/update', 'id' => $id]);

        }

        return new MethodNotAllowedHttpException('Harus melalui prosedur penghapusan data.');
    }

    public function actionDownloadManual($id)
    {
        ini_set('max_execution_time', 5 * 60);
        $model = $this->findModel($id);
        $file = Yii::getAlias('@produkPath' . "/{$model->manual}");
        return Yii::$app->response->sendFile($file);
    }

    public function actionDownloadGaleri($id)
    {
        ini_set('max_execution_time', 5 * 60);
        $model = GaleriProduk::findOne($id);
        $file = Yii::getAlias('@produkPath' . "/{$model->nama_berkas}");
        return Yii::$app->response->sendFile($file);

    }

    public function actionHapusGaleri($id)
    {

        if (Yii::$app->request->isPost) {

            $data = Yii::$app->request->post();

            $id = $data['id'];
            $galeri = GaleriProduk::findOne($id);
            $idProduk = $galeri->id_produk;
            $path = Yii::getAlias('@penjual/web/upload/produk');
            $deleteDokumen = FileHelper::unlink($path . "/" . $galeri->nama_berkas);
            if ($deleteDokumen) {
                $galeri->delete();
                Yii::$app->session->setFlash('success', 'Berhasil menghapus dokumen led');
                return $this->redirect(['produk/update', 'id' => $idProduk]);

            }
            Yii::$app->session->setFlash('success', 'Gagal menghapus dokumen led');
            return $this->redirect(['produk/update', 'id' => $idProduk]);

        }

        return new MethodNotAllowedHttpException('Harus melalui prosedur penghapusan data.');
    }
}
