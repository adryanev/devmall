<?php

namespace penjual\controllers;


use yii\helpers\ArrayHelper;
use common\models\DataAlamat;

use common\models\User;
use common\models\VerifikasiUser;
use penjual\models\forms\profile\AlamatForm;
use penjual\models\forms\profile\FotoProfilForm;
use penjual\models\forms\profile\GantiPasswordForm;
use penjual\models\forms\profile\InformasiPribadiForm;
use penjual\models\forms\profile\VerifikasiForm;
use penjual\models\forms\profile\VerifikasiNomorHpForm;
use Yii;
use yii\helpers\Url;
use yii\web\Response;
use yii\web\UploadedFile;

class ProfileController extends \yii\web\Controller
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


    public function actionIndex()
    {
        $user = Yii::$app->user->identity;

        $modelDataAlamat = new DataAlamat();
        $dataProvinsi = $modelDataAlamat->getProvinsi();
        $dataProvinsi = ArrayHelper::map($dataProvinsi, 'id', 'nama');    

        $is_phone_verified = (new \yii\db\Query())
                                ->select("is_phone_verified")
                                ->from("user")
                                ->where("id=". $user->getId())
                                ->all();
        $is_phone_verified = $is_phone_verified[0]['is_phone_verified'];

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
           'is_phone_verified' => $is_phone_verified,
           'modelAlamat'=>$modelAlamat,
           'modelVerifikasi'=>$modelVerfikasi,
           'verifikasiSekarang'=>$verifikasiSekarang,
           'dataProvinsi' => $dataProvinsi
           ]);
    }

    public function actionGetKota()
    {

        $modelDataAlamat = new DataAlamat();            
                 
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $out = [];
            if (isset($_POST['depdrop_parents'])) {
                $parents = $_POST['depdrop_parents'];
                if ($parents != null) {

                    $id_provinsi = $parents[0];
                    $out =  $modelDataAlamat->getKota($id_provinsi); 
                    $kota = array();

                    foreach ($out as  $key => $value) {
                    
                        $kota[$key] = array('id' => $value->id, 'name'=> $value->nama );

                    }
                    return ['output' => $kota, 'selected'=>''];
                }
            }
        return ['output'=>'', 'selected'=>''];
    }    


    public function actionGetKecamatan()
    {

        $modelDataAlamat = new DataAlamat();            
                 
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $out = [];
            if (isset($_POST['depdrop_parents'])) {
                $parents = $_POST['depdrop_parents'];
                if ($parents != null) {
                    
                    $id_kota = $parents[0];
                    $out =  $modelDataAlamat->getKecamatan($id_kota); 
                    $kecamatan = array();

                    foreach ($out as  $key => $value) {
                    
                        $kecamatan[$key] = array('id' => $value->id, 'name'=> $value->nama );

                    }
                    return ['output' => $kecamatan, 'selected'=>''];
                }
            }
        return ['output'=>'', 'selected'=>''];
    }   

    public function actionGetKelurahan()
    {

        $modelDataAlamat = new DataAlamat();            
                 
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $out = [];
            if (isset($_POST['depdrop_parents'])) {
                $parents = $_POST['depdrop_parents'];
                if ($parents != null) {
                    
                    $id_kecamatan = $parents[0];
                    $out =  $modelDataAlamat->getKelurahan($id_kecamatan); 
                    $kelurahan = array();

                    foreach ($out as  $key => $value) {
                    
                        $kelurahan[$key] = array('id' => $value->id, 'name'=> $value->nama );

                    }
                    return ['output' => $kelurahan, 'selected'=>''];
                }
            }
        return ['output'=>'', 'selected'=>''];
    }


}
