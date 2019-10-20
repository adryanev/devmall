<?php

namespace penjual\controllers;

use common\models\Kategori;
use common\models\Produk;
use penjual\models\forms\ProdukForm;
use penjual\models\ProdukSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
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
        return $this->render('view', [
            'model' => $this->findModel($id),
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
        $model = new ProdukForm();
        $kategori = Kategori::find()->all();
        $dataKategori = ArrayHelper::map($kategori, 'id', 'nama');

        if ($model->load(Yii::$app->request->post())) {
            var_dump(Yii::$app->request->post());
            exit();
            $model->galeri = UploadedFile::getInstances($model, 'galeri');

            $produk = $model->create();
            Yii::$app->session->setFlash('success', 'Berhasil menambahkan Produk.');

            return $this->redirect(['view', 'id' => $this->findModel($produk->id)->id]);
        }
        return $this->render('create', [
            'model' => $model,
            'dataKategori' => $dataKategori
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
        $model = new ProdukForm($id);
        $kategori = Kategori::find()->all();
        $dataKategori = ArrayHelper::map($kategori, 'id', 'nama');

        if ($model->load(Yii::$app->request->post())) {
            $update = $model->update();
            Yii::$app->session->setFlash('success', 'Berhasil mengubah Produk.');

            return $this->redirect(['view', 'id' => $update->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'dataKategori' => $dataKategori

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
}
