<?php


namespace frontend\controllers;


use common\models\Keranjang;
use common\models\Produk;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class KeranjangController extends Controller
{


    public function behaviors()
    {
        return [
            'verbs'=>[
                'class'=>VerbFilter::class,
                'actions' => [
                    'tambah'=>['POST'],
                    'hapus'=> ['POST'],
                ]
            ]
        ];
    }

    public function actionTambah(){

        $data = Yii::$app->request->post();
        $keranjang = new Keranjang();
        $keranjang->id_user = $data['user'];
        $keranjang->id_produk = $data['produk'];
        $keranjang->save(false);

        return $this->redirect(Yii::$app->request->referrer ?: $this->goBack());
    }

    public function actionHapus(){
        $data = Yii::$app->request->post();
        $keranjang = Keranjang::findOne(['id_produk'=>$data['produk'],'id_user'=>$data['user']]);
        $keranjang->delete();

        return $this->redirect(Yii::$app->request->referrer ?: $this->goBack());

    }

    public function actionIndex(){
        $keranjang = \Yii::$app->user->identity->getKeranjangs();
        $keranjangCount = $keranjang->count();
        $keranjangDataProvider = new ActiveDataProvider(['query' => $keranjang]);
        $keranjangTotal = array_sum(array_values(ArrayHelper::map($keranjang->all(),'harga','harga')));


        return $this->render('index',compact('keranjang','keranjangCount','keranjangDataProvider','keranjangTotal'));
    }
}