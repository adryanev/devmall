<?php


namespace frontend\controllers;


use common\models\Ulasan;
use yii\filters\AccessControl;
use yii\web\Controller;

class UlasanController extends Controller
{

    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::class,
                'rules'=>[
                    [
                        'allow'=>true,
                        'roles'=>['@']
                    ]
                ]
            ]
        ];
    }

    public function actionCreate($produk){
        $model = new Ulasan();
        $model->id_produk = $produk;
        $model->id_user = \Yii::$app->user->identity->id;

        if($model->load(\Yii::$app->request->post())){

            if($model->save(false)){
                return $this->redirect(['produk/view','id'=>$model->id_produk]);
            }
        }

        return $this->render('create',['model'=>$model]);
    }
}
