<?php

namespace frontend\controllers;

use common\models\Booth;
use common\models\Notifikasi;
use common\models\Produk;
use common\models\User;
use frontend\models\forms\KeluhanUploadForm;
use Yii;
use common\models\Keluhan;
use frontend\models\KeluhanSearch;
use yii\bootstrap4\ActiveForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * KeluhanController implements the CRUD actions for Keluhan model.
 */
class KeluhanController extends Controller
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
     * Lists all Keluhan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KeluhanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Keluhan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Keluhan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($produk)
    {
        $model = new Keluhan();
        $uploadModel = new KeluhanUploadForm();
        $model->id_user = Yii::$app->user->identity->id;
        $model->id_produk = $produk;
        $model->status = Keluhan::STATUS_DIKIRIM;
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $uploadModel->load(Yii::$app->request->post()) ) {
            $uploadModel->dokumen = UploadedFile::getInstance($uploadModel,'dokumen');
            if($result = $uploadModel->upload()){
                $model->dokumen = $result;
            }
            $model->save(false);
            $this->sendNotification($model,$model->user, $model->produk->booth, $model->produk);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        elseif (Yii::$app->request->isAjax){
            return $this->renderAjax('_form',['model'=>$model,'uploadModel'=>$uploadModel]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Keluhan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Keluhan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Keluhan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Keluhan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function sendNotification(Keluhan $keluhan,User $pengguna, Booth $penjual, Produk $produk)
    {
        $notification = new Notifikasi();
        $notification->sender = $pengguna->id;
        $notification->receiver = $penjual->id;
        $notification->context = "User {$pengguna->username} mengirimkan keluhan tentang produk {$produk->nama} ";
        $notification->id_data = $keluhan->id;
        $notification->jenis_data = 'Keluhan';
        $notification->status = 'Belum Dibaca';

        $notification->save(false);
    }
}
