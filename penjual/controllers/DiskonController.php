<?php

namespace penjual\controllers;

use common\models\Notifikasi;

use common\models\Diskon;
use common\models\Produk;
use penjual\models\DiskonSearch;
use Yii;
use yii\bootstrap4\ActiveForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;


/**
 * DiskonController implements the CRUD actions for Diskon model.
 */
class DiskonController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['actions' => ['index', 'create', 'update', 'view', 'delete'],
                        'allow' => true,
                        'roles' => ['@']
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
     * Lists all Diskon models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DiskonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Diskon model.
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
     * Finds the Diskon model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Diskon the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Diskon::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new Diskon model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $notif = new Notifikasi();
        $model = new Diskon();
        $dataProduk = $this->getProduk();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
            
            Yii::$app->request->post()['Diskon']['persentase'] = 10;

            if ($model->save()) {
            
                Yii::$app->session->setFlash('success', 'Berhasil menambahkan Diskon.');

                // $notif->id_data = Yii::$app->db->getLastInsertId();
                // $notif->sender = Yii::$app->user->identity->booth->id;
                // $notif->receiver = 1;
                // $notif->context = 'Booth menambahkan Diskon baru dengan id';
                // $notif->jenis_data ='Diskon';
                // $notif->status ='Belum Dibaca';

                // $notif->save();


                return $this->redirect(['view', 'id' => $model->id]);

            }

        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', ['model' => $model, 'dataProduk' => $dataProduk]);
        }

        return $this->render('create', [
            'model' => $model,
            'dataProduk' => $dataProduk
        ]);
    }

    private function getProduk()
    {
        return ArrayHelper::map(Produk::find()->where(['id_booth' => Yii::$app->user->identity->booth->id])->all(), 'id', 'nama');
    }

    /**
     * Updates an existing Diskon model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $dataProduk = $this->getProduk();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Berhasil mengubah Diskon.');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'dataProduk' => $dataProduk
        ]);
    }

    /**
     * Deletes an existing Diskon model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', 'Berhasil menghapus Diskon.');

        return $this->redirect(['index']);
    }
}
