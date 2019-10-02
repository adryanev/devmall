<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 10/1/2019
 * Time: 9:07 PM
 */

namespace frontend\models\forms\setting;


use common\models\User;
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
    public $koordinat;

    private $_langitude;
    private $_longitude;
    private $_profil;

    public function __construct($id = 0,$config = [])
    {
        if($id ===0){
            throw new NotFoundHttpException('Data yang anda cari tidak ada');
        }

        $user = User::findOne($id);
        $this->_profil = $user->profilUser;
        $this->setAttributes($this->_profil->attributes);
        parent::__construct($config);
    }

}