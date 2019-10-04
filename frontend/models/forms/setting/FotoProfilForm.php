<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 10/1/2019
 * Time: 9:09 PM
 */

namespace frontend\models\forms\setting;


use Carbon\Carbon;
use common\models\constants\FileExtension;
use common\models\User;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use yii\web\UploadedFile;

class FotoProfilForm extends Model
{

    /**
     * @var UploadedFile
     */
    public $avatar;

    private $_profil;

    public function rules()
    {
        return [
            ['avatar','required'],
            ['avatar','file','skipOnEmpty' => true,'extensions' => FileExtension::FOTO]
        ];
    }

    public function __construct($id ,$config = [])
    {

        if(empty($id)){
            throw new InvalidArgumentException('Data yang anda cari tidak ditemukan');
        }

        $user = User::findOne($id);
        $this->_profil= $user->profilUser;

        parent::__construct($config);
    }

    public function upload(){
        $timestamp = Carbon::now()->timestamp;
        if(!$this->validate()){
            return false;
        }
        $file = $this->avatar->getBaseName().'.'.$this->avatar->getExtension();
        $fileName = $timestamp.'-'.$file;



        return true;
    }
}