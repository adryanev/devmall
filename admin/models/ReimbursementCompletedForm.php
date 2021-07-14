<?php


namespace admin\models;

use Carbon\Carbon;
use common\models\Model;
use common\models\Reimbursement;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class ReimbursementCompletedForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $bukti;

    /** @var Reimbursement */
    private $_reimburse;

    public function __construct(Reimbursement $reimburse, $config = [])
    {
        $this->_reimburse = $reimburse;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['bukti','required'],
            ['bukti','file','skipOnEmpty' => false, 'extensions' => ['jpeg','jpg','png','bmp','gif']]
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $timestamp = Carbon::now()->timestamp;
        $filename = "$timestamp-{$this->bukti->name}";
        FileHelper::createDirectory(Yii::getAlias('@penjual/web/upload/reimbursement'));
        $this->bukti->saveAs(Yii::getAlias('@penjual/web/upload/reimbursement/' . $filename));

        $this->_reimburse->bukti = $filename;
        $this->_reimburse->status = Reimbursement::STATUS_COMPLETED;

        return $this->_reimburse->save(false)? $this->_reimburse:false;
    }
}
