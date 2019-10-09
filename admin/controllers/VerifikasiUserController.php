<?php

namespace admin\controllers;

use Yii;
use yii\filters\AccessControl;
use common\models\VerifikasiUser;
use admin\models\VerifikasiUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\bootstrap4\ActiveForm;


/**
 * VerifikasiUserController implements the CRUD actions for VerifikasiUser model.
 */
class VerifikasiUserController extends Controller
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
                    ['actions'=>['index','terima','tolak','view','delete'],
                     'allow'=>true,
                     'roles'=>['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'terima' => ['POST'],
                    'tolak' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all VerifikasiUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VerifikasiUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VerifikasiUser model.
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
     * Creates a new VerifikasiUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionTerima($id)
    {
        $model =$this->findModel($id);
        $model->status = VerifikasiUser::STATUS_DITERIMA;
        $model->save(false);
        Yii::$app->session->setFlash('success','Berhasil menyetujui verifikasi');
        return $this->redirect('index');
    }

    /**
     * Updates an existing VerifikasiUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionTolak($id)
    {
        $model = $this->findModel($id);

        $model->status = VerifikasiUser::STATUS_DITOLAK;
        $model->save(false);
        Yii::$app->session->setFlash('success','Berhasil menolak verifikasi');

        return $this->redirect('index');
    }

    /**
     * Deletes an existing VerifikasiUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success','Berhasil menghapus VerifikasiUser.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the VerifikasiUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VerifikasiUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VerifikasiUser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
