<?php

namespace penjual\controllers;

use common\models\PembayaranTransaksiPermintaan;
use common\models\PermintaanProduk;
use common\models\PermintaanProdukDetail;
use common\models\RiwayatPermintaan;
use common\models\TransaksiPermintaan;
use penjual\models\forms\KeteranganPermintaanForm;
use penjual\models\forms\ProgressPermintaanForm;
use penjual\models\PermintaanSearch;
use Yii;
use yii\base\DynamicModel;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class PermintaanController extends Controller
{

    public function actionIndex()
    {

        $searchModel = new PermintaanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    public function actionView($id)
    {
        $progress = new ProgressPermintaanForm();

        $model = $this->findModel($id);
        $progress->id_permintaan = $model->id;
        $keteranganForm = new KeteranganPermintaanForm($model->id);
        $dataProgress = RiwayatPermintaan::find()->where(['id_permintaan_produk' => $model->id]);
        $dataProgressProvider = new ActiveDataProvider(['query' => $dataProgress]);
        $dataPembayaran = $model->transaksiPermintaan->getRiwayatTransaksiPermintaans();
        $dataPembayaranProvider =new ActiveDataProvider(['query' => $dataPembayaran]);

        if ($model->id_booth !== Yii::$app->user->identity->booth->id) {
            throw new MethodNotAllowedHttpException('Maaf Ini bukan data anda');
        }

        return $this->render('view', compact('model', 'keteranganForm', 'progress', 'dataProgressProvider','dataPembayaranProvider'));
    }

    protected function findModel($id)
    {
        $model = PermintaanProduk::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
        }
        return $model;
    }

    public function actionDownload($id)
    {
        $file = PermintaanProdukDetail::findOne($id);
        if ($file->permintaan->id_booth !== Yii::$app->user->identity->booth->id) {
            throw new MethodNotAllowedHttpException('Maaf anda tidak bisa mengakses halaman ini');
        }

        $path = Yii::getAlias('@permintaanPath/'.$file->nama_berkas);
        return Yii::$app->response->sendFile($path);
    }

    public function actionTerima()
    {

        $data = Yii::$app->request->post();
        $keteranganModel = new KeteranganPermintaanForm($data['id']);
        $model = $this->findModel($data['id']);
        $db = Yii::$app->db->beginTransaction();
        if ($keteranganModel->load(Yii::$app->request->post())) {
            try {
                if (!$keteranganModel->save()) {
                    $db->rollBack();
                    return $this->redirect(['view', 'id' => $model->id]);
                }

                $model->status = PermintaanProduk::STATUS_DITERIMA;
                if (!$model->update(false)) {
                    $db->rollBack();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                $transaksi_permintaan = new TransaksiPermintaan();
                $transaksi_permintaan->id_permintaan = $model->id;
                $transaksi_permintaan->belum_dibayar = $model->harga;
                $transaksi_permintaan->sudah_dibayar = 0;
                $transaksi_permintaan->status = TransaksiPermintaan::STATUS_PENDING;
                if (!$transaksi_permintaan->save(false)) {
                    $db->rollBack();
                    return $this->redirect(['view', 'id' => $model->id]);
                }

                $detail = new PembayaranTransaksiPermintaan();
                $detail->id_transaksi_permintaan = $transaksi_permintaan->id;
                $detail->nominal = $transaksi_permintaan->permintaan->uang_muka;
                $detail->status = PembayaranTransaksiPermintaan::STATUS_PENDING;
                $detail->jenis = PembayaranTransaksiPermintaan::JENIS_UANG_MUKA;

                if (!$detail->save(false)) {
                    $db->rollBack();
                    return $this->redirect(['view', 'id' => $model->id]);
                }

                $db->commit();
            } catch (Exception $exception) {
                $db->rollBack();
                return $exception;
            }
        }
        //TODO: Kirim Email dan Notifikasi

        Yii::$app->session->setFlash('success', Yii::t('app', 'Permintaan Diterima'));

        return $this->redirect(['permintaan/view', 'id' => $model->id]);
    }

    public function actionTolak()
    {

        $data = Yii::$app->request->post();
        $model = $this->findModel($data['id']);
        $keteranganModel = new KeteranganPermintaanForm($data['id']);
        if ($keteranganModel->load($data)) {
            $keteranganModel->save();
            $model->status = PermintaanProduk::STATUS_DITOLAK;
            $model->update(false);
        }

        Yii::$app->session->setFlash('success', Yii::t('app', 'Permintaan Ditolak'));
        return $this->redirect(['permintaan/index']);
    }

    public function actionTambahProgress($id)
    {
        $model = new ProgressPermintaanForm();
        $permintaan = $this->findModel($id);
        $model->id_permintaan = $permintaan->id;

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form-progress', ['model' => $model, 'permintaan' => $permintaan]);
        }


        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                if (Yii::$app->request->isAjax) {
                    // JSON response is expected in case of successful save
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['success' => true];
                }
                return $this->redirect(['view', 'id' => $permintaan->id]);
            }
        }

        return $this->render('tambah-progress', ['model' => $model, 'permintaan' => $permintaan]);
    }

    public function actionUpdateProgress($id)
    {

        $progress = $this->findProgress($id);
        $permintaan = $this->findModel($progress->id_permintaan_produk);
        $model = new ProgressPermintaanForm($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->update();

            return $this->redirect(['permintaan/view', 'id' => $model->id_permintaan]);
        }

        return $this->render('tambah-progress', ['model' => $model, 'permintaan' => $permintaan]);

    }

    protected function findProgress($id)
    {
        $model = RiwayatPermintaan::findOne(['id'=>$id]);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        return $model;
    }

    public function actionHapusProgress($id)
    {

        $model = $this->findProgress($id);
        $permintaan = $model->id_permintaan_produk;
        $model->delete();

        return $this->redirect(['permintaan/view', 'id' => $permintaan]);
    }

    public function actionMintaBayar($id)
    {
        $permintaan = $this->findModel($id);
        $transaksi = $permintaan->transaksiPermintaan;
        $model = new DynamicModel(['id', 'nominal']);
        $model->addRule(['id', 'nominal'], 'required')
            ->addRule(['id', 'nominal'], 'integer');
        $model->id = $transaksi->id;



        if($model->load(Yii::$app->request->post())){
            $riwayat = new PembayaranTransaksiPermintaan();
            $riwayat->id_transaksi_permintaan = $transaksi->id;
            $riwayat->status = PembayaranTransaksiPermintaan::STATUS_PENDING;
            $riwayat->jenis = PembayaranTransaksiPermintaan::JENIS_ANGSURAN;
            $riwayat->nominal = $model->nominal;

            if($riwayat->save(false)){
                if(Yii::$app->request->isAjax){

                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['success'=>true];
                }
            }


        }
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('_form-minta-bayar',compact('model','permintaan'));
        }

        return $this->render('minta-bayar',compact('model','transaksi','permintaan'));
    }

    public function actionUpdatePermintaanBayar($id){
        $model = $this->findRiwayatTransaksiPermintaan($id);
        $modelPermintaan = new DynamicModel(['id','nominal']);
        $modelPermintaan->addRule(['id','nominal'],'required')
            ->addRule(['id','nominal'],'integer');
        $modelPermintaan->id = $model->id;
        $modelPermintaan->nominal = $model->nominal;

        if($modelPermintaan->load(Yii::$app->request->post()))
        {
            $model->nominal = $modelPermintaan->nominal;
            if($model->update(false)){
                return $this->redirect(['view','id'=>$model->transaksiPermintaan->id_permintaan]);
            }
        }
        return $this->render('update-permintaan',['model'=>$modelPermintaan,'permintaan'=>$model->transaksiPermintaan->permintaan]);

    }

    protected function findRiwayatTransaksiPermintaan($id){
        $model = PembayaranTransaksiPermintaan::findOne($id);
        if(!$model){
            throw new NotFoundHttpException();
        }

        return $model;
    }

    public function actionHapusPermintaanBayar($id){
        $model = $this->findRiwayatTransaksiPermintaan($id);
        $idPermintaan = $model->transaksiPermintaan->id_permintaan;
        $model->delete();
        return $this->redirect(['view','id'=>$idPermintaan]);
    }
}
