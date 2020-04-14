<?php


namespace frontend\controllers;

use common\models\PembayaranTransaksiPermintaan;
use common\models\PermintaanProduk;
use common\models\PermintaanProdukDetail;
use frontend\helpers\FlashHelper;
use frontend\models\forms\permintaan\PermintaanDetailUploadForm;
use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\MethodNotAllowedHttpException;
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
                $model->status = PermintaanProduk::STATUS_DIKIRIM;

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
                    if (!$modelDetail->save($model)) {
                        $flash = FlashHelper::DANGER;
                        $flash['message'] = 'Terjadi kesalahan saat mengunggah berkas anda.';
                        Yii::$app->session->setFlash('danger', $flash);
                        $db->rollBack();

                        return $this->redirect(Url::current());
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

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $dataDetail = $model->getPermintaanProdukDetails();
        $modelDetail = new PermintaanDetailUploadForm();

        if ($model->load(Yii::$app->request->post())) {
            try {
                $db = Yii::$app->db->beginTransaction();
                $model->status = PermintaanProduk::STATUS_DIKIRIM;

                if (!$model->save(false)) {
                    $flash = FlashHelper::DANGER;
                    $flash['message'] = 'Terjadi kesalahan saat menyimpan permintaan anda';
                    Yii::$app->session->setFlash('danger', $flash);
                    $db->rollBack();

                    return $this->redirect(Url::current());
                }
                $files = UploadedFile::getInstances($modelDetail, 'uploadedFiles');
                if (!empty($files)) {
                    $modelDetail->uploadedFiles = $files;

                    if ($uploaded = $modelDetail->upload()) {
                        if (!$modelDetail->save($model)) {
                            $flash = FlashHelper::DANGER;
                            $flash['message'] = 'Terjadi kesalahan saat mengunggah berkas anda.';
                            Yii::$app->session->setFlash('danger', $flash);
                            $db->rollBack();

                            return $this->redirect(Url::current());
                        }
                    }
                }
                $db->commit();
                $flash = FlashHelper::SUCCESS;
                $flash['message'] = 'Berhasil mengirim permintaan anda';
                Yii::$app->session->setFlash('success', $flash);

                return $this->redirect(['permintaan/view', 'id' => $model->id]);
            } catch (Exception $exception) {
                $db->rollBack();
                throw  $exception;
//                return $this->redirect(Url::current());
            }
        }
        return $this->render('update', ['model' => $model, 'modelDetail' => $modelDetail, 'dataDetail' => $dataDetail]);
    }

    protected function findModel($id)
    {
        $model = PermintaanProduk::findOne(['id'=>$id,'id_user'=>Yii::$app->user->identity->getId()]);
        if (!$model) {
            throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
        }
        return $model;
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $flash = [];
        if (!$model->status === PermintaanProduk:: STATUS_DIKERJAKAN || !$model->status === PermintaanProduk::STATUS_DITERIMA || !$model->status === PermintaanProduk::STATUS_SELESAI) {
            $model->delete();
            $flash = FlashHelper::DANGER;
            $flash['message'] = 'Maaf terjadi kesalahan';
            Yii::$app->session->setFlash('danger', $flash);
            return $this->redirect(['permintaan/index']);
        }
        $flash = FlashHelper::SUCCESS;
        $flash['message'] = 'Berhasil menghapus permintaan';
        Yii::$app->session->setFlash('success', $flash);
        return $this->redirect(['permintaan/index']);
    }

    public function actionDeleteFile($id)
    {
//        $id = Yii::$app->request->post('id');
        $file = PermintaanProdukDetail::findOne($id);
        if ($file->permintaan->id_user !== Yii::$app->user->identity->getId()) {
            throw new MethodNotAllowedHttpException('Anda tidak berhak melakukan aksi ini');
        }
        $modelId = $file->id_permintaan;
        $path = Yii::getAlias('@permintaanPath/' . $file->nama_berkas);
        FileHelper::unlink($path);
        $file->delete();

        $flash = FlashHelper::SUCCESS;
        $flash['message'] = 'Berhasil menghapus dokumen permintaan';
        Yii::$app->session->setFlash('success', $flash);

        return $this->redirect(['permintaan/update', 'id' => $modelId]);
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
        $unpaid = $model->transaksiPermintaan;
        if ($unpaid) {
            $unpaid = $unpaid->getRiwayatTransaksiPermintaans()->where(['status' => PembayaranTransaksiPermintaan::STATUS_PENDING])->one();
        }
        if ($model->id_user !== Yii::$app->user->identity->getId()) {
            throw new UnauthorizedHttpException('Oops, permintaan ini bukan milik anda');
        }

        return $this->render('view', ['model' => $model, 'unpaid' => $unpaid]);
    }

    public function actionProgress($id){
        $model = $this->findModel($id);
        $progress = $model->riwayatPermintaans;

        return $this->render('progress',compact('model','progress'));
    }
}
