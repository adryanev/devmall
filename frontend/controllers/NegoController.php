<?php

namespace frontend\controllers;


use Carbon\Carbon;
use common\models\Nego;
use common\models\Produk;
use common\models\RiwayatNego;
use common\models\HargaNego;
use frontend\models\forms\nego\NegoForm;
use Yii;
use yii\bootstrap4\ActiveForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class NegoController extends Controller
{

    public function actionAdd()
    {

        if (Yii::$app->request->post()) {


            Yii::$app->response->format = Response::FORMAT_JSON;

            $data = Yii::$app->request->post('NegoForm');
            $produk = Produk::findOne($data['produk']);

            $today = Carbon::today()->timestamp;
            $tomorrow = Carbon::tomorrow()->timestamp;
            //cek berapa kali hari ini
            $cek = RiwayatNego::find()->where(['id_user' => Yii::$app->user->identity->getId()])->andWhere(['id_produk' => $produk->id])->andWhere(['between', 'waktu_nego', $today, $tomorrow])->count();



            if ($cek >= 3) {


                Yii::$app->session->set('jumlahNego',4);

                return $this->redirect(Yii::$app->request->referrer);
            }
            //simpan riwayat nego
            $riwayatNego = new RiwayatNego();
            $nego = new NegoForm($produk);
            $riwayatNego->id_user = Yii::$app->user->identity->getId();
            $riwayatNego->id_produk = $produk->id;
            $riwayatNego->waktu_nego = Carbon::now()->timestamp;

            if ($nego->load(Yii::$app->request->post())) {

                $riwayatNego->harga = $nego->harga;
                $riwayatNego->save(false);
                $response['status'] = 'success';
                $response['message'] = 'Berhasil menyimpan nego';
                $response['counter'] = $cek + 1;

            }

            //cek harga nego
            $negoModel = Nego::findOne(['id_produk' => $produk->id]);

            if ($cek < 3) {

                if ($nego->harga < $negoModel->harga_tiga) {
                    //transaksi tidak berhasil
                    // Yii::$app->session->set('jumlahNego',1);
                    $this->actionTolak();

                }else{
                    $nego->simpanHarga();
                    $this->actionTerima($produk->id, $nego->harga);
                }

            }

        }
        return $response;

    }


    protected function actionTolak()
    {
        Yii::$app->session->set('jumlahNego',1);
        Yii::$app->session->setFlash('danger',[
                    'type'=>'danger',
                    'icon'=> 'fas fa-times',
                    'message'=>'Maaf, Harga Nego Terlalu Rendah.',
                    'title'=>'Gagal',
            ]);

        return $this->redirect(Yii::$app->request->referrer);
    }

    protected function actionTerima($id_produk, $harga)
    {

        Yii::$app->session->setFlash('success',[
                    'type'=>'success',
                    'icon'=> 'fas fa-times',
                    'message'=>'Selamat. Harga Nego Diterima. Silahkan Tambah Ke Chart / Checkout Sekarang.',
                    'title'=>'Berhasil',
            ]);

        return $this->redirect(Yii::$app->request->referrer);

    }
}
