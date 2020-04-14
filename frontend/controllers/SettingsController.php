<?php

namespace frontend\controllers;



use common\models\User;
use common\models\VerifikasiUser;
use frontend\models\forms\setting\AlamatForm;
use frontend\models\forms\setting\FotoProfilForm;
use frontend\models\forms\setting\GantiPasswordForm;
use frontend\models\forms\setting\InformasiPribadiForm;
use frontend\models\forms\setting\VerifikasiForm;
use frontend\models\forms\setting\VerifikasiNomorHpForm;
use Yii;
use yii\helpers\Url;
use yii\web\Response;
use yii\web\UploadedFile;

class SettingsController extends \yii\web\Controller
{
    public function actionSendSmsVerification(){
        Yii::$app->response->format = Response::FORMAT_JSON;

        if(Yii::$app->request->isAjax){
            $user = Yii::$app->user->identity;
            $model = User::findOne($user->getId());
            $nomor_hp = Yii::$app->request->post('nomor');
            $model->generateSmsVerification();
            $model->save(false);
//            $basic  = new \Nexmo\Client\Credentials\Basic('d75f194a', 'Jw2u9WHhTkuJWUBV');
//            $client = new \Nexmo\Client($basic);
//
//             $message = $client->message()->send([
//            'to' => $nomor_hp,
//            'from' => 'Devmall',
//            'text' => 'Kode verifikasi Devmall anda: '.$model->sms_verification
//        ]);


            return ['status'=>'ok','nomor'=>$nomor_hp,'kode'=>$model->sms_verification];

        }



    }
    public function actionAccount()
    {
        $user = Yii::$app->user->identity;

        $modelInformasi = new InformasiPribadiForm($user->getId());
        $modelPassword = new GantiPasswordForm($user->getId());
        $modelProfil = new FotoProfilForm($user->getId());
        $modelHp = new VerifikasiNomorHpForm($user->getId());
        $modelAlamat = new AlamatForm($user->getId());
        $modelVerfikasi = new VerifikasiForm($user->getId());

        $verifikasiSekarang = VerifikasiUser::find()->where(['id_user'=>$user->getId()])->orderBy('id DESC')->one();

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

        if($modelProfil->load(Yii::$app->request->post())){
            $modelProfil->avatar = UploadedFile::getInstance($modelProfil,'avatar');
            if(!$modelProfil->upload()){
                Yii::$app->session->setFlash('danger',[
                    'type'=>'danger',
                    'icon'=> 'fas fa-times',
                    'message'=>'Gagal mengganti foto profil',
                    'title'=>'Gagal'
                ]);
                return $this->redirect(Url::current());
            }

            Yii::$app->session->setFlash('success',[
                'type' => 'success',
                'icon' => 'fas fa-check',
                'message' => 'Berhasil Mengubah Foto Profil',
                'title' => 'Berhasil!',
            ]);

            return $this->redirect(Url::current());

        }

        if($modelHp->load(Yii::$app->request->post())){
            if($modelHp->save()){
                Yii::$app->session->setFlash('success',[
                    'type' => 'success',
                    'icon' => 'fas fa-check',
                    'message' => 'Berhasil verifikasi nomor hp',
                    'title' => 'Berhasil!',
                ]);
            }
            else{
                Yii::$app->session->setFlash('danger',[
                    'type'=>'danger',
                    'icon'=> 'fas fa-times',
                    'message'=>'Gagal mengganti verifikasi nomor hp',
                    'title'=>'Gagal'
                ]);
            }

            return $this->redirect(Url::current());

        }

        if($modelAlamat->load(Yii::$app->request->post())&& $modelAlamat->save()){
            Yii::$app->session->setFlash('success',[
                'type' => 'success',
                'icon' => 'fas fa-check',
                'message' => 'Berhasil mengganti alamat',
                'title' => 'Berhasil!',
            ]);

            return $this->redirect(Url::current());

        }

        if($modelVerfikasi->load(Yii::$app->request->post())){
            $modelVerfikasi->berkas = UploadedFile::getInstance($modelVerfikasi,'berkas');
            if($modelVerfikasi->save()){
                Yii::$app->session->setFlash('success',[
                    'type' => 'success',
                    'icon' => 'fas fa-check',
                    'message' => 'Berhasil mengirim verifikasi, admin akan memproses permintaan anda',
                    'title' => 'Berhasil!',
                ]);
                return $this->redirect(Url::current());

            }
            Yii::$app->session->setFlash('danger',[
                'type'=>'danger',
                'icon'=> 'fas fa-times',
                'message'=>'Gagal mengirim Verifikasi Identitas, Silahkan coba lagi',
                'title'=>'Gagal'
            ]);

            return $this->redirect(Url::current());

        }



       return $this->render('account',['modelInformasi'=>$modelInformasi,
           'modelPassword'=>$modelPassword,
           'modelProfil'=>$modelProfil,
           'modelHp'=>$modelHp,
           'modelAlamat'=>$modelAlamat,
           'modelVerifikasi'=>$modelVerfikasi,
           'verifikasiSekarang'=>$verifikasiSekarang
           ]);
    }

}
