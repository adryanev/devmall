<?php
/**
 * devmall
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 */
namespace admin\models;
use common\models\User;
use common\models\ProfilUser;
use Yii;
use yii\base\Model;

/**
 * Class UserSignupForm
 */
class AdminSign extends Model
{

    public $username;
    public $email;
    public $password;
    public $level_akses;

    public $nama_depan;
    public $nama_belakang;


    public function rules(){
        return[
            [['username','email', 'nama_depan','level_akses'],'required'],
            [['nama_belakang'], 'safe'],
            ['username','trim'],
            ['email','trim'],

            [['username','email'],'string'],
            ['email','email'],
            [['username'],'unique','targetClass' => User::class, 'message' => 'Username sudah digunakan'],
            [['email'],'unique','targetClass' => User::class,'message' => 'Email sudah digunakan'],
            ['password','string','min' => 8],
        ];
    }

    public function signup(){
        if(!$this->validate()){
            echo "invalid";
            exit();
            return null;
        }

        $user = new User();
        $profil = new ProfilUser();

        $attributeUser = [
            'username'=>$this->username,
            'email'=>$this->email
        ];

        $attributeProfil = [
            'nama_depan'=>$this->nama_depan,
            'nama_belakang'=>$this->nama_belakang
        ];

        $user->level_akses = $this->level_akses;

        $user->setAttributes($attributeUser);
        $profil->setAttributes($attributeProfil);        

        $profil->avatar = 'user_default.png';

        $user->setPassword($this->password);
        $user->generateAuthKey();

        $user->status = User::STATUS_ACTIVE;

        $tersimpan = $user->save(false);
        $profil->id_user = $user->id;
        $profil->save(false);

        $auth = Yii::$app->authManager;
        $userRole = $auth->getRole('admin');
        $auth->assign($userRole,$user->id);

        return $user;
    }

    public function update($id){
 

        $query= (new \yii\db\Query())
        ->select("*")
        ->from("user")
        ->where("id!='".$id."' AND (username ='".$this->username."' OR email ='".$this->email."' )")
        ->all();

        if (count($query) > 0) {
            echo "Username atau Email Sudah digunakan";
            exit();
            return null;
        }

        $command = Yii::$app->db->createCommand("UPDATE user SET username='".$this->username."', email='".$this->email."' WHERE id='".$id."'");
        $command->execute();

        $command = Yii::$app->db->createCommand("UPDATE profil_user SET nama_depan='".$this->nama_depan."', nama_belakang='".$this->nama_belakang."' WHERE id_user='".$id."'");
        $command->execute();
        
    }

}