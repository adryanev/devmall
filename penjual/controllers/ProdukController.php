<?php

namespace penjual\controllers;

use common\models\Notifikasi;

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

        $notif = new Notifikasi();
        $model = new Produk();
        $negoModel = new Nego();
        $galeriModel = new GaleriProduk();
        $galeriModel->scenario = 'create';
        $dataGaleri = null;
        /** @var $booth Booth */

        $booth = Yii::$app->user->identity->booth;
        if ($model->load(Yii::$app->request->post()) && $negoModel->load(Yii::$app->request->post()) && $galeriModel->load(Yii::$app->request->post())) {
            preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $model->video, $matches);
            $model->video = $matches[1];

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


                $notif->id_data = $model->id;
                $notif->sender = Yii::$app->user->identity->booth->id;
                $notif->receiver = 1;
                $notif->context = 'Booth menambahkan Produk baru dengan id '.$notif->id_data;
                $notif->jenis_data ='Produk';
                $notif->status ='Belum Dibaca';

                $notif->save(false);

            if ($model->nego) {

                if ( $model->harga > $negoModel->harga_satu && $negoModel->harga_satu > $negoModel->harga_dua && $negoModel->harga_dua > $negoModel->harga_tiga ) {

                    $nego = new Nego();
                    $nego->setAttributes($negoModel->attributes);
                    $nego->harga_produk = $model->harga;
                    $nego->id_produk = $model->id;;
                    $nego->save(false);

                }else{

                    Yii::$app->session->setFlash('danger', 'Harga Nego Harus Lebih Kecil Dari Harga Normal. Dan Hara Nego Dua Harus Lebih Kecil Dari Harga Nego Satu');

                    return $this->render('create', [
                        'model' => $model,
                        'negoModel' => $negoModel,
                        'galeriModel' => $galeriModel,
                        'dataGaleri' => $dataGaleri

                    ]);

                }
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

                $trans = $transaction->commit();


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
        $notif = new Notifikasi();
        $model = Produk::findOne($id);

        $negoModel = $model->nego0;
        if(empty($negoModel)){
            $negoModel = new Nego();
        }
        $galeriModel = new GaleriProduk();
        $booth = Yii::$app->user->identity->booth;

        $dataGaleri = GaleriProduk::find()->where(['id_produk' => $model->id])->all();

        if ($model->load(Yii::$app->request->post()) && $negoModel->load(Yii::$app->request->post()) && $galeriModel->load(Yii::$app->request->post())) {

            preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $model->video, $matches);
            if($matches){
                $model->video = $matches[1];
            }

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
            if (!$model->update(false)) {
                throw new Exception('Gagal menyimpan produk');
            }

            $notif->id_data = $model->id;
            $notif->sender = Yii::$app->user->identity->booth->id;
            $notif->receiver = 1;
            $notif->context = 'Booth menambahkan Produk baru dengan id '.$notif->id_data;
            $notif->jenis_data ='Produk';
            $notif->status ='Belum Dibaca';

            $notif->save(false);

            if ($model->nego) {
                if($negoModel){

                    $nego = Nego::find()->where(['id_produk' => $model->id ])->one();

                    $negoModel->harga_produk = $model->harga;
                    $negoModel->id_produk = $model->id;
                    $negoModel->setAttributes($negoModel->attributes);

                    if (is_null($nego)) {

                        $negoModel->save(false);

                    }else{

                        $negoModel->update(false);
                    }

                }

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

                $notif->id_data = $id;
                $notif->sender = Yii::$app->user->identity->booth->id;
                $notif->receiver = 1;
                $notif->context = 'Booth mengubah data Produk dengan id';
                $notif->jenis_data ='Produk';
                $notif->status ='Belum Dibaca';

                $notif->save();

                Yii::$app->session->setFlash('success', 'Berhasil mengubah Produk.');
                return $this->redirect(['produk/view', 'id' => $model->id]);

            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }

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
        // if (Yii::$app->request->isPost) {

            // $data = Yii::$app->request->post();

            // $id = $data['id'];
            $id = $_GET['id'];
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

        // }

        // return new MethodNotAllowedHttpException('Harus melalui prosedur penghapusan data.');
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

        // if (Yii::$app->request->isPost) {

            // $data = Yii::$app->request->post();

            $id = $_GET['id'];
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

        // }

        // return new MethodNotAllowedHttpException('Harus melalui prosedur penghapusan data.');
    }
}
