<?php


namespace frontend\controllers;


use Carbon\Carbon;
use common\models\Nego;
use common\models\Produk;
use common\models\RiwayatNego;
use frontend\models\forms\nego\NegoForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class NegoController extends Controller
{

    public function actionAdd()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = [];
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post('NegoForm');
            $produk = Produk::findOne($data['produk']);

            $today = Carbon::today()->timestamp;
            $tomorrow = Carbon::tomorrow()->timestamp;
            //cek berapa kali hari ini
            $cek = RiwayatNego::find()->where(['id_user' => Yii::$app->user->identity->getId()])->andWhere(['between', 'waktu_nego', $today, $tomorrow])->count();
            if ($cek >= 3) {
                $response['status'] = 'error';
                $response['message'] = 'Maaf, Nego hanya bisa 3x dalam 1 hari.';
                $response['counter'] = $cek;

                return $response;
            }
            //simpan riwayat nego
            $riwayatNego = new RiwayatNego();
            $nego = new NegoForm($produk->id);
            $riwayatNego->id_user = Yii::$app->user->identity->getId();
            $riwayatNego->id_produk = $produk->id;
            $riwayatNego->waktu_nego = Carbon::now()->timestamp;
            if ($nego->load(Yii::$app->request->post())) {
                $nego->simpanHarga();
                $riwayatNego->harga = $nego->harga;
                $riwayatNego->save(false);
                $response['status'] = 'success';
                $response['message'] = 'Berhasil menyimpan nego';
                $response['counter'] = $cek + 1;


            }
            //cek harga nego
            $negoModel = Nego::findOne(['id_produk' => $produk->id]);
            if ($nego->harga < $negoModel->harga_tiga) {
                $response['nego'] = [
                    'status' => 'error',
                    'message' => ''
                ];
            }

        }

        return $response;


    }
}