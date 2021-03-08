<?php


namespace frontend\models\forms\permintaan;

use Carbon\Carbon;
use common\models\constants\FileExtension;
use common\models\PermintaanProduk;
use common\models\PermintaanProdukDetail;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class PermintaanDetailUploadForm extends Model
{

    /** @var UploadedFile[] */
    public $uploadedFiles;

    private $_files;

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
            $path = Yii::getAlias('@webroot/upload/permintaan');
            $files = [];
            foreach ($this->uploadedFiles as $file) {
                $timestamp = Carbon::now()->timestamp;
                $filename = $timestamp . '-' . $file->baseName . '.' . $file->extension;
                $file->saveAs("$path/$filename");
                $files[$filename] = $file->extension;
            }
            $this->_files = $files;

            return $files;
        }

        return null;
    }


    public function save(/** @var $permintaan PermintaanProduk */ $permintaan)
    {
        $uploaded = $this->_files;
        foreach ($uploaded as $file => $ext) {
            $detail = new PermintaanProdukDetail();
            $detail->id_permintaan = $permintaan->id;
            $detail->nama_berkas = $file;
            $detail->jenis_berkas = $ext;

            if (!$detail->save(false)) {
                return false;
            }
        }

        return true;
    }
}
