<?php


namespace frontend\models\forms;


use Carbon\Carbon;
use common\models\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class KeluhanUploadForm extends Model
{

    /**
     * @var UploadedFile
     */
    public $dokumen;

    public function rules()
    {
        return [
            ['dokumen','required'],
            ['dokumen','file','skipOnEmpty' => false,'extensions' => 'pdf, docx, doc, jpg, png, bmp, jpeg, mp4, mkv, mov']
        ];
    }

    public function upload(){
        $path = \Yii::getAlias('@keluhanPath/'.\Yii::$app->user->identity->id);
        FileHelper::createDirectory($path);
        $timestamp = Carbon::now()->timestamp;
        $fileName = "$timestamp-{$this->dokumen->name}";
        $status = $this->dokumen->saveAs("$path/$fileName");
        return $status ? $fileName : null;
    }
}
