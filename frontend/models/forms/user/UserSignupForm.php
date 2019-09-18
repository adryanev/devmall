<?php
/**
 * devmall
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 */
namespace frontend\models\forms\user;
use common\models\ProfilUser;
use common\models\User;
use Yii;
use yii\base\Model;

/**
 * Class UserSignupForm
 */
class UserSignupForm extends Model
{


    public $username;
    public $email;
    public $nama_depan;
    public $nama_belakang;
    public $password;
    public $agreement = false;

    public function rules(){
        return[
            [['username','email','password','nama_depan','agreement'],'required'],

            ['agreement','boolean'],
            [['nama_belakang'],'safe'],
            ['username','trim'],
            ['email','trim'],

            [['username','email'],'string'],
            ['email','email'],
            [['username'],'unique','targetClass' => User::class, 'message' => 'Username sudah digunakan'],


            [['email'],'unique','targetClass' => User::class,'message' => 'Email sudah digunakan'],

            ['password','string','min' => 8],
            [['nama_depan','nama_belakang'],'string','max' => 20]
        ];
    }

    public function signup(){
        if(!$this->validate()) return null;

        $user = new User();
        $profil = new ProfilUser();

        $attributeUser = [
            'username'=>$this->username,
            'email'=>$this->email,
        ];

        $attributeProfil = [
            'nama_depan'=>$this->nama_depan,
            'nama_belakang'=>$this->nama_belakang
        ];
        $user->setAttributes($attributeUser);
        $profil->setAttributes($attributeProfil);
        $profil->avatar = 'user_default.png';

        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        $user->status = User::STATUS_INACTIVE;

        $user->save(false);
        $profil->save(false);

        $this->sendEmailVerification($user);

        return $user;
    }

    protected function sendEmailVerification($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }

}