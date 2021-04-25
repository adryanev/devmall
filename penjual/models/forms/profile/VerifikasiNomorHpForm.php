<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 10/1/2019
 * Time: 9:15 PM
 */

namespace penjual\models\forms\profile;


use borales\extensions\phoneInput\PhoneInputBehavior;
use borales\extensions\phoneInput\PhoneInputValidator;
use common\models\User;
use InvalidArgumentException;
use yii\base\Model;

class VerifikasiNomorHpForm extends Model
{

    public $nomor_hp;
    public $kode_verifikasi;

    private $_user;

    public function rules()
    {
        return [
            [['nomor_hp','kode_verifikasi'],'required'],
            [['nomor_hp'], 'string'],
            [['nomor_hp'], PhoneInputValidator::className(),'region' => ['id']],
            [['kode_verifikasi'],'string','max' => 6,'min' => 6]
            ];
    }

    public function behaviors()
    {
        return [
            ['class'=>PhoneInputBehavior::class,
                'phoneAttribute' => 'nomor_hp']
        ];
    }
    public function __construct($id, $config = [])
    {
        if(empty($id)){
            throw new InvalidArgumentException('Data yang anda cari tidak ditemukan');
        }

        $this->_user = User::findOne($id);
        $this->nomor_hp = $this->_user->nomor_hp;

        parent::__construct($config);
    }

    public function save(){
        if(!$this->_user->sms_verification == $this->kode_verifikasi){
            return false;
        }
        $this->_user->nomor_hp = $this->nomor_hp;
        $this->_user->is_phone_verified = User::STATUS_PHONE_VERIFIED;

        $this->_user->save(false);

        return $this->_user;
    }
}