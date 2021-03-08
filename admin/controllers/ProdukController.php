<?php

namespace admin\controllers;

use Yii;
use Carbon\Carbon;
use yii\filters\AccessControl;
use common\models\Produk;
use common\models\GaleriProduk;
use common\models\Nego;
use admin\models\ProdukSearch;
use yii\web\Controller;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\bootstrap4\ActiveForm;
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
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    ['actions'=>['index','create','update','view','delete'],
                     'allow'=>true,
                     'roles'=>['@']
                    ]
                ]
            ],
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
     * Creates a new Produk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Produk();

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {


            $model->save();
            Yii::$app->session->setFlash('success','Berhasil menambahkan Produk.');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        elseif (Yii::$app->request->isAjax){
            return $this->renderAjax('_form',['model'=>$model]);
        }

        return $this->render('create', [
            'model' => $model,
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
        if(empty($negoModel)){
            $negoModel = new Nego();
        }
     
        $galeriModel = new GaleriProduk();

        print_r(Yii::$app->user->identity);
        die();

        $booth = Yii::$app->user->identity->booth;

        $dataGaleri = GaleriProduk::find()->where(['id_produk' => $model->id])->all();

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
            if (!$model->update(false)) {
                throw new Exception('Gagal menyimpan produk');
            }
            if ($model->nego) {
                if($negoModel){
                    $negoModel->id_produk = $model->id;;
                    $negoModel->setAttributes($negoModel->attributes);
                    $negoModel->update(false);

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

        Yii::$app->session->setFlash('success','Berhasil menghapus Produk.');

        return $this->redirect(['index']);
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
}
