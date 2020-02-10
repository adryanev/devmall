<?php


namespace frontend\controllers;

use common\models\PermintaanProduk;
use common\models\PermintaanProdukDetail;
use frontend\helpers\FlashHelper;
use frontend\models\forms\permintaan\PermintaanDetailUploadForm;
use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UnauthorizedHttpException;
use yii\web\UploadedFile;

class PermintaanController extends Controller
{

    public function actionTambah($id)
    {
        $model = new PermintaanProduk();
        $modelDetail = new PermintaanDetailUploadForm();

        $model->id_booth = $id;
        $model->id_user = Yii::$app->user->identity->getId();


        if ($model->load(Yii::$app->request->post())) {
            try {
                $db = Yii::$app->db->beginTransaction();
                $model->status = PermintaanProduk::PERMINTAAN_DIKIRIM;

                if (!$model->save(false)) {
                    $flash = FlashHelper::DANGER;
                    $flash['message'] = 'Terjadi kesalahan saat menyimpan permintaan anda';
                    Yii::$app->session->setFlash('danger', $flash);
                    $db->rollBack();

                    return $this->redirect(Url::current());
                }
                $files = UploadedFile::getInstances($modelDetail, 'uploadedFiles');
                $modelDetail->uploadedFiles = $files;

                if ($uploaded = $modelDetail->upload()) {
                    foreach ($uploaded as $file => $ext) {
                        $detail = new PermintaanProdukDetail();
                        $detail->id_permintaan = $model->id;
                        $detail->nama_berkas = $file;
                        $detail->jenis_berkas = $ext;

                        if (!$detail->save(false)) {
                            $flash = FlashHelper::DANGER;
                            $flash['message'] = 'Terjadi kesalahan saat mengunggah berkas anda.';
                            Yii::$app->session->setFlash('danger', $flash);
                            $db->rollBack();

                            return $this->redirect(Url::current());
                        }
                    }

                    $db->commit();
                    $flash = FlashHelper::SUCCESS;
                    $flash['message'] = 'Berhasil mengirim permintaan anda';
                    Yii::$app->session->setFlash('success', $flash);

                    return $this->redirect(['permintaan/view', 'id' => $model->id]);
                }
            } catch (Exception $exception) {
                $db->rollBack();
                throw  $exception;
//                return $this->redirect(Url::current());
            }
        }
        return $this->render('tambah', ['model' => $model, 'modelDetail' => $modelDetail]);
    }


    public function actionIndex()
    {
        $model = PermintaanProduk::find()->where(['id_user' => Yii::$app->user->identity->id]);
        $dataProvider = new ActiveDataProvider(['query' => $model]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        if ($model->id_user !== Yii::$app->user->identity->getId()) {
            throw new UnauthorizedHttpException('Oops, permintaan ini bukan milik anda');
        }

        return $this->render('view', ['model' => $model]);
    }

    protected function findModel($id)
    {
        $model = PermintaanProduk::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
        }
        return $model;
    }
}
