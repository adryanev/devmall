<?php

namespace penjual\controllers;

use common\models\Booth;
use common\models\Notifikasi;
use common\models\Produk;
use common\models\VersiProduk;
use penjual\models\forms\VersiProdukUploadForm;
use penjual\models\VersiProdukSearch;
use Yii;
use yii\bootstrap4\ActiveForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;


/**
 * VersiProdukController implements the CRUD actions for VersiProduk model.
 */
class VersiProdukController extends Controller
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
                    [
                        'actions' => ['index', 'create', 'update', 'view', 'delete'],
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
     * Lists all VersiProduk models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VersiProdukSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VersiProduk model.
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
     * Finds the VersiProduk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VersiProduk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VersiProduk::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new VersiProduk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new VersiProduk();
        $uploadModel = new VersiProdukUploadForm();
        $produk = $this->findProduk($id);
        $model->id_produk = $produk->id;
        $model->link_lama = $produk->download_link;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $uploadModel->load(Yii::$app->request->post())) {
            $uploadModel->dokumen = UploadedFile::getInstances($uploadModel, 'dokumen');
            if ($filename = $uploadModel->upload($model->produk)) {
                $model->cara_instalasi = $filename;
            }
            $model->save();
            Yii::$app->session->setFlash('success', 'Berhasil menambahkan VersiProduk.');
            $produk->download_link = $model->link_baru;
            $produk->save(false);

            $detail = $produk->transaksiDetails;
            $user = [];
            foreach ($detail as $d) {
                $tp = $d->transaksi->getUser()->distinct()->one();
                $user[] = $tp;
            }
            $this->sendNotification($produk->booth, $user, $produk);
            return $this->redirect(['produk/view', 'id' => $model->produk->id]);
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', ['model' => $model, 'uploadModel' => $uploadModel]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the VersiProduk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Produk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findProduk($id)
    {
        if (($model = Produk::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function sendNotification(Booth $booth, array $users, Produk $produk)
    {
        foreach ($users as $user) {
            $notif = new Notifikasi();
            $notif->sender = $booth->id;
            $notif->receiver = $user->id;
            $notif->context = "Produk $produk->nama terdapat pembaruan yang tersedia";
            $notif->id_data = $produk->id;
            $notif->jenis_data = 'Produk';
            $notif->status = Notifikasi::STATUS_NOT_READ;
            $notif->save(false);
        }

    }

    /**
     * Updates an existing VersiProduk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $uploadModel = new VersiProdukUploadForm();
        $produk = $model->produk;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save() && $uploadModel->load(Yii::$app->request->post())) {
            $uploadModel->dokumen = UploadedFile::getInstance($uploadModel, 'dokumen');
            if ($filename = $uploadModel->upload($model->produk)) {
                $model->cara_instalasi = $filename;
            }
            $produk->download_link = $model->link_baru;
            $produk->save(false);
            Yii::$app->session->setFlash('success', 'Berhasil mengubah VersiProduk.');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'uploadModel' => $uploadModel
        ]);
    }

    /**
     * Deletes an existing VersiProduk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $produk = $model->produk;
        $produk->download_link = $model->link_lama;
        $produk->save(false);
        $model->delete();
        Yii::$app->session->setFlash('success', 'Berhasil menghapus VersiProduk.');

        return $this->redirect(['index']);
    }
}
