<?php


namespace penjual\models\forms;


use Carbon\Carbon;
use common\models\Model;
use common\models\Produk;
use yii\web\UploadedFile;

class VersiProdukUploadForm extends Model
{

    /** @var UploadedFile */
    public $dokumen;

    public function rules()
    {
        return [
            ['dokumen', 'required'],
            ['dokumen', 'file', 'skipOnEmpty' => false]
        ];
    }

    public function upload(Produk $produk)
    {
        $timestamp = Carbon::now()->timestamp;
        $filename = "$timestamp-{$this->dokumen->name}";

        $path = \Yii::getAlias('@penjual/web/upload/produk/');
        $result = $this->dokumen->saveAs("$path/$produk->id_booth/$filename");

        return $result ? $filename : null;
    }
}
