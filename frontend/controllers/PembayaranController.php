<?php


namespace frontend\controllers;


use common\models\Keranjang;
use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class PembayaranController extends Controller
{

    public function actionCheckout(){

        /** @var $user User */
        $user = Yii::$app->user->identity;

        $keranjang = Keranjang::find()->where(['id_user'=>$user->id]);
        $keranjangDataProvider = new ActiveDataProvider(['query' => $keranjang]);
        if(empty($user->nomor_hp)){
            Yii::$app->session->setFlash('success',[
                'type' => 'danger',
                'icon' => 'fas fa-stop',
                'message' => 'Untuk bisa bertransaksi, verifikasi dulu nomor hp anda.',
                'title' => 'Verifikasi Nomor Hp!',
            ]);
            return $this->redirect(['settings/account']);
        }
        return $this->render('checkout',compact('user','keranjangDataProvider'));
    }
}