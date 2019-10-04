<?php

namespace frontend\controllers;



use frontend\models\forms\setting\GantiPasswordForm;
use frontend\models\forms\setting\InformasiPribadiForm;
use Yii;
use yii\helpers\Url;

class SettingsController extends \yii\web\Controller
{
    public function actionAccount()
    {
        $user = Yii::$app->user->identity;

        $modelInformasi = new InformasiPribadiForm($user->getId());
        $modelPassword = new GantiPasswordForm($user->getId());

        if($modelInformasi->load(Yii::$app->request->post())){
            if(!$modelInformasi->validate()){
                Yii::$app->session->setFlash('warning',[
                    'type' => 'warning',
                    'icon' => 'fas fa-info',
                    'message' => 'Terjadi kesalahan',
                    'title' => 'Peringatan!',
                ]);
                return $this->redirect(Url::current());
            }

            $modelInformasi->save();
            Yii::$app->session->setFlash('success',[
                'type' => 'success',
                'icon' => 'fas fa-check',
                'message' => 'Berhasil Mengubah Informasi Pribadi',
                'title' => 'Berhasil!',
            ]);
        }
        if($modelPassword->load(Yii::$app->request->post())){
            if(!$modelPassword->validate()){
                Yii::$app->session->setFlash('warning',[
                    'type' => 'warning',
                    'icon' => 'fas fa-info',
                    'message' => 'Terjadi kesalahan',
                    'title' => 'Peringatan!',
                ]);
                return $this->redirect(Url::current());
            }

            if($modelPassword->updatePassword()) {

                Yii::$app->session->setFlash('success',[
                    'type' => 'success',
                    'icon' => 'fas fa-check',
                    'message' => 'Berhasil Mengubah Kata Sandi',
                    'title' => 'Berhasil!',
                ]);
                   return  $this->redirect(Url::current());
            }
        }



       return $this->render('account',['modelInformasi'=>$modelInformasi,
           'modelPassword'=>$modelPassword]);
    }

}
