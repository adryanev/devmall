<?php

namespace admin\controllers;

use Yii;
use yii\filters\AccessControl;
use admin\models\AdminSign;
use admin\models\GantiPassword;
use common\models\User;
use common\models\ProfilUser;
use mdm\admin\models\searchs\User as UserSearch;
use mdm\admin\models\Assignment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\bootstrap4\ActiveForm;
 use yii\helpers\Url;

/**
 * KategoriController implements the CRUD actions for Kategori model.
 */
class KelolaAdminController extends Controller
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
                    ['actions'=>['index','create','update','view','delete', 'change'],
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

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'superadmin');

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

        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelProfile' => $this->findModelProfile($id),
        ]);
    }

    /**
     * Creates a new Kategori model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new AdminSign();

        $model->level_akses='admin';

        if ($model->load(Yii::$app->request->post())) {


            if ($model->validate()) {
                
                if ($user = $model->signup()) {
                    Yii::$app->session->setFlash('success','Berhasil menambahkan Admin.');  
                    // return $this->redirect(['view', 'id' => $model->id]);
                    return $this->redirect(['index']);
                }
            }
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
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelProfile = $this->findModelProfile($id);
        $modelSave = new AdminSign();

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {

            $modelSave->username = Yii::$app->request->post()['User']['username'];
            $modelSave->email = Yii::$app->request->post()['User']['email'];
            $modelSave->nama_depan = Yii::$app->request->post()['ProfilUser']['nama_depan'];
            $modelSave->nama_belakang = Yii::$app->request->post()['ProfilUser']['nama_belakang'];             
            $modelSave->update($id);

            Yii::$app->session->setFlash('success','Berhasil mengubah Data Admin.');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'modelProfile' => $modelProfile
        ]);
    }

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

        Yii::$app->session->setFlash('success','Berhasil menghapus Data Admin.');

        return $this->redirect(['index']);
    }

    public function actionChange($id)
    {

        $modelPassword = new GantiPassword($id);

        if($modelPassword->load(Yii::$app->request->post())){
            if(!$modelPassword->validate()){

                Yii::$app->session->setFlash('warning','Kata Sandi Lama Salah.');
                
                return  $this->redirect(Url::current());
            }

            if($modelPassword->updatePassword()) {

                // Yii::$app->session->setFlash('success',[
                //     'type' => 'success',
                //     'icon' => 'fas fa-check',
                //     'message' => 'Berhasil Mengubah Kata Sandi',
                //     'title' => 'Berhasil!',
                // ]);
                Yii::$app->session->setFlash('success','Berhasil Mengubah Kata Sandi.');

                return $this->redirect(['index']);

            }
        }


        return $this->render('change-password', [
            'modelPassword' => $modelPassword,
        ]);
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
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findModelProfile($id_user)
    {
        if (($model = ProfilUser::find()->where(['id_user' => $id_user ])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
