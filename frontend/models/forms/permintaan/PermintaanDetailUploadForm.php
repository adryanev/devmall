<?php


namespace frontend\models\forms\permintaan;


use Carbon\Carbon;
use common\models\constants\FileExtension;
use yii\base\Model;
use yii\web\UploadedFile;

class PermintaanDetailUploadForm extends Model
{

    /** @var UploadedFile[] */
    public $uploadedFiles;

    public function rules()
    {
        return [
            ['uploadedFiles', 'file', 'skipOnEmpty' => false, 'extensions' => FileExtension::DOKUMEN, 'maxFiles' => 5]
        ];
    }

    public function attributeLabels()
    {
        return ['uploadedFiles' => 'Berkas pendukung'];
    }

    public function upload()
    {
        if ($this->validate()) {
            $path = \Yii::getAlias('@webroot/upload/permintaan');
            $files = [];
            foreach ($this->uploadedFiles as $file) {
                $timestamp = Carbon::now()->timestamp;
                $filename = $timestamp . '-' . $file->baseName . '.' . $file->extension;
                $file->saveAs("$path/$filename");
                $files[$filename] = $file->extension;

            }

            return $files;
        }

        return null;
    }

}