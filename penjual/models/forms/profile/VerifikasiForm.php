<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 10/1/2019
 * Time: 9:07 PM
 */

namespace penjual\models\forms\profile;


use Carbon\Carbon;
use common\models\User;
use common\models\VerifikasiUser;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use yii\web\UploadedFile;

class VerifikasiForm extends Model
{
    /** @var UploadedFile */
    public $berkas;

    /** @var User */
    private $_user;

    public function rules(){
        return [
            [['berkas'],'required'],
            [['berkas'],'file','skipOnEmpty' => true,'extensions' => ['jpg','png','jpeg','pdf']]

        ];
    }
    public function __construct($id,$config = [])
    {
        if(empty($id)){
            throw new InvalidArgumentException('Data yang anda cari tidak ditemukan');

        }

        $this->_user = User::findOne($id);
        if(!$this->_user){
            throw new InvalidArgumentException('Data yang anda cari tidak ditemukan');
        }

        parent::__construct($config);
    }

    public function save(){
        if(!$this->validate()){
            return false;
        }
        $verifikasi = new VerifikasiUser();
        $verifikasi->id_user = $this->_user->id;

        $timestamp = Carbon::now()->timestamp;
        $filename = $timestamp.'-'.$this->berkas->getBaseName().'.'.$this->berkas->getExtension();
        $verifikasi->jenis_verifikasi = 'ktp';
        $verifikasi->nama_file = $filename;
        $verifikasi->status = VerifikasiUser::STATUS_DIKIRIM;

        if(!$this->berkas->saveAs(\Yii::getAlias('@webroot').'/upload/verifikasi/'.$filename)){
            return false;
        }




        return $verifikasi->save(false)? $verifikasi: false;

    }
}