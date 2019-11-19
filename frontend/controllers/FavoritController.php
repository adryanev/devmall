<?php


namespace frontend\controllers;


use common\models\Favorit;
use common\models\Produk;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class FavoritController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs'=>[
                'class'=>VerbFilter::class,
                'actions' => [
                    'add'=>['POST'],
                    'remove'=>['POST']
                ]
            ]
        ];
    }

    public function actionAdd($id){

        $produk = $this->findProduk($id);
        $data = \Yii::$app->request->post();
        $user = $data['user'];
        $favorit = new Favorit();
        $favorit->id_produk = $produk->id;
        $favorit->id_user = $user;
        $favorit->save(false);

        return $this->redirect(Yii::$app->request->referrer ?: $this->goBack());
    }

    public function actionRemove($id){
        $produk = $this->findProduk($id);
        $data = \Yii::$app->request->post();
        $user = $data['user'];
        $favorit = Favorit::findOne(['id_produk'=>$produk->id,'id_user'=>$user]);
        $favorit->delete();
        return $this->redirect(Yii::$app->request->referrer ?: $this->goBack());
    }

    protected function findProduk($id){
        $model = Produk::findOne($id);
        if(!$model){
            throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
        }
        return $model;
    }
}