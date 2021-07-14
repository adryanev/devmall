<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 10/1/2019
 * Time: 9:07 PM
 */

namespace penjual\models\forms\profile;


use common\models\ProfilUser;
use common\models\User;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use yii\web\NotFoundHttpException;

class AlamatForm extends Model
{

    public $alamat1;
    public $alamat2;
    public $kelurahan;
    public $kecamatan;
    public $kota;
    public $provinsi;
    /** @var ProfilUser  */
    private $_profil;

    public function __construct($id = 0,$config = [])
    {
        if($id ===0){
            throw new InvalidArgumentException('Data yang anda cari tidak ada');
        }

        $user = User::findOne($id);
        $this->_profil = $user->profilUser;
        $this->setAttributes($this->_profil->attributes);
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['alamat1','kelurahan','kecamatan','kota','provinsi'],'required'],
            ['alamat2','safe'],

            [['alamat1','alamat2'],'string','max' => 100],
            [['kelurahan','kecamatan','kota','provinsi'],'string','max' => 50]
        ];
    }

    public function save(){
        if(!$this->validate()){
            return false;
        }

        $this->_profil->setAttributes($this->attributes);
        return $this->_profil->save(false)? $this->_profil : false;
    }



}