<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 9/24/2019
 * Time: 8:26 PM
 */

namespace penjual\models\forms;


use yii\base\Model;
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
    /** @var UploadedFile */
    public $banner;

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
            ['banner','file','skipOnEmpty' => true]
        ];
    }

    private function getLatLong($koordinat){

    }

}