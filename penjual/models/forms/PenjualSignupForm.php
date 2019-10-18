<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 9/24/2019
 * Time: 8:26 PM
 */

namespace penjual\models\forms;


use Carbon\Carbon;
use yii\base\Model;
use yii\helpers\StringHelper;
use yii\web\UploadedFile;
use common\models\Booth;
use common\models\VerifikasiUser;

class PenjualSignupForm extends Model
{

    public $nama;
    public $email;
    public $deskripsi;


    public $alamat1;
    public $alamat2;
    public $kelurahan;
    public $kecamatan;
    public $kota;
    public $provinsi;
    public $koordinat;


    public $nomor_telepon;

    /** @var UploadedFile */
    public $avatar;


    public $terms = false;

    private $_latitude;
    private $_longitude;


    public function rules()
    {
        return [
            [['nama','email','deskripsi','alamat1','kelurahan','kecamatan','kota','provinsi','nomor_telepon','koordinat','terms'],'required'],
            [['alamat2','banner','avatar'],'safe'],

            ['nama','string','max' => 100,'min'=>1],
            ['email','email'],
            ['deskripsi','string','max' => 250],
            [['alamat1','alamat2'],'string','max' => 100],
            [['kelurahan','kecamatan','kota','provinsi'], 'string','max' => 50],
            ['avatar','file','skipOnEmpty' => true],
        ];
    }

    private function getLatLong($koordinat){
        $cord = StringHelper::explode($koordinat,',');
        $this->_latitude = $cord[0];
        $this->_longitude = $cord[1];
    }

    public function signup(){
        $penjual = new Booth();
        $penjual->setAttributes($this->attributes);
        $this->getLatLong($this->koordinat);
        $penjual->latitude = $this->_latitude;
        $penjual->longitude = $this->_longitude;

        if(!empty($this->avatar)){
            $timestamp = Carbon::now()->timestamp;
            $filename = $timestamp.'-'.$this->avatar->baseName.'.'.$this->avatar->extension;
            $penjual->avatar = $filename;
            $this->avatar->saveAs(\Yii::getAlias('@webroot/upload/verifikasi/'.$filename));
        }
        else{
            $penjual->avatar = 'default.jpg';
        }

        return $penjual->save(false)? $penjual : null;
    }



}