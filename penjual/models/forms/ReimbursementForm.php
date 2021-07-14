<?php


namespace penjual\models\forms;


use common\models\Booth;
use common\models\Reimbursement;

class ReimbursementForm extends \yii\base\Model
{

    public $bank;
    public $nomor_rekening;
    public $amount;

    /** @var Booth */
    private $_booth;

    public function __construct($booth,$config = [])
    {
        $this->_booth = $booth;
        parent::__construct($config);
    }

    public function attributeLabels()
    {
        return [
          'amount'=>'Jumlah'
        ];
    }
    public function rules()
    {
        return [
          [['amount','bank','nomor_rekening'],'required'],
          ['amount','integer'],
            [['bank','nomor_rekening'],'string'],
            ['amount','checkJumlah']
        ];
    }

    public function checkJumlah($attribute, $params){

        if (!$this->hasErrors()) {
            $booth = $this->_booth;
            if (!$booth || ($booth->coin->saldo < $this->amount)) {
                $this->addError($attribute,'Ups, Sepertinya saldo kamu tidak cukup.');
                return false;
            }

        }
        return true;
    }

    public function save(){

        if(!$this->validate()){
            return false;
        }
        $model = new Reimbursement();
        $model->id_booth = $this->_booth->id;
        $model->bank = $this->bank;
        $model->nomor_rekening = $this->nomor_rekening;
        $model->amount = $this->amount;
        $model->status = Reimbursement::STATUS_CREATED;


        return   $model->save(false)? $model: false;
    }
}
