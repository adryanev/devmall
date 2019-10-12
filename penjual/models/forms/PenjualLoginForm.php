<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 9/30/2019
 * Time: 9:35 PM
 */

namespace penjual\models\forms;


use common\models\LoginForm;
use common\models\User;
use Yii;

class PenjualLoginForm extends LoginForm
{


    public function login()
    {

        $user = $this->getUser();

        if($user->status === User::STATUS_VERIFIED){
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 : 0);
        }
        return false;
    }
}