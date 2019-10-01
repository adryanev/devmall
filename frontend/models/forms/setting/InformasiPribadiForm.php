<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 10/1/2019
 * Time: 9:06 PM
 */

namespace frontend\models\setting;


use common\models\ProfilUser;
use common\models\User;
use Yii;
use yii\base\Model;
use yii\web\NotFoundHttpException;

class InformasiPribadiForm extends Model
{

    public $nama_depan;
    public $nama_belakang;
    public $email;
    public $tanggal_lahir;
    public $jenis_kelamin;
    public $pekerjaan;

    /** @var User */
    private $_user;
    /** @var ProfilUser */
    private $_profil;

    public function __construct($id = 0,$config = [])
    {
        if($id===0){
            throw new NotFoundHttpException('Data yang anda cari tidak ada');
        }
        $this->_user = User::findOne($id);
        $this->_profil = $this->_user->profilUser;
        parent::__construct($config);


    }

    public function rules()
    {
        return [
            [['email','nama_depan','nama_belakang'],'required'],
            [['nama_belakang','nama_depan','pekerjaan'],'string','max' => 20],
            ['tanggal_lahir','integer'],
            ['jenis_kelamin','integer'],
            ['jenis_kelamin','in','range' => [1,2]],



            ['email','string','max' => 255],
            ['email','trim'],
            ['email','email'],
            [['jenis_kelamin','pekerjaan','tanggal_lahir'],'safe']
        ];
    }

    public function save(){

        if($this->email !== $this->_user->email){
            $this->_user->email = $this->email;
            $this->_user->generateEmailVerificationToken();
            $this->_user->status = User::STATUS_NOT_VERIFIED;
            $this->sendVerificationEmail($this->_user);
        }

        $profilAttr = [
            'nama_depan'=>$this->nama_depan,
            'nama_belakang'=>$this->nama_belakang,
            'tanggal_lahir'=>$this->tanggal_lahir,
            'pekerjaan'=>$this->pekerjaan,
            'jenis_kelamin'=>$this->jenis_kelamin
        ];

        $this->_profil->setAttributes($profilAttr);

        $this->_user->save(false);
        $this->_profil->save(false);
    }

    private function sendVerificationEmail($user){

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Verifikasi Email pada ' . Yii::$app->name)
            ->send();

    }


}