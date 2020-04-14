<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 10/1/2019
 * Time: 9:06 PM
 */

namespace frontend\models\forms\setting;


use common\models\ProfilUser;
use common\models\User;
use InvalidArgumentException;
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

    public function __construct($id ,$config = [])
    {
        if (empty($id)) {
            throw new InvalidArgumentException('Pengguna tidak ditemukan');
        }
        $this->_user = User::findOne($id);
        if (!$this->_user) {
            throw new InvalidArgumentException('Pengguna yang dicari tidak ada');
        }
        $this->_profil = $this->_user->profilUser;
        $this->setAttributes($this->_user->attributes);
        $this->setAttributes($this->_profil->attributes);
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
            Yii::$app->session->setFlash('Silahkan cek email anda');
        }

        $profilAttr = [
            'nama_depan'=>$this->nama_depan,
            'nama_belakang'=>$this->nama_belakang,
            'tanggal_lahir'=>$this->tanggal_lahir,
            'pekerjaan'=>$this->pekerjaan,
            'jenis_kelamin'=>$this->jenis_kelamin
        ];

        $this->_profil->setAttributes($profilAttr);



        return ( $this->_user->save(false) &&
        $this->_profil->save(false)) ? $this->_user : null;
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