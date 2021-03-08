<?php

namespace admin\controllers;

use Yii;
use yii\filters\AccessControl;
use admin\models\NotifikasiSearch;
use common\models\Notifikasi;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\bootstrap4\ActiveForm;

/**
 * KategoriController implements the CRUD actions for Kategori model.
 */
class NotifikasiController extends Controller
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
     * Lists all Kategori models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        $searchModel = new NotifikasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kategori model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $model = $this->findModel($id);

        $model->status ='Sudah Dibaca';
        $updated = $model->save();

        switch ($model['jenis_data']) {
            case 'Produk':
                return $this->redirect(['produk/index?ProdukSearch%5Bid%5D='.$model['id_data']]);
                break;
            
        }

    }

    /**
     * Creates a new Kategori model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new User();

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {

            $simpan = $model->save();
        }

        elseif (Yii::$app->request->isAjax){
            return $this->renderAjax('_form',['model'=>$model]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Kategori model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
    //         Yii::$app->response->format = Response::FORMAT_JSON;
    //         return ActiveForm::validate($model);
    //     }
    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         Yii::$app->session->setFlash('success','Berhasil mengubah Kategori.');

    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('update', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Deletes an existing Kategori model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success','Berhasil menghapus Kategori.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Kategori model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kategori the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notifikasi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
