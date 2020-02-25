<?php


namespace penjual\models\forms;

use common\models\PermintaanProduk;
use yii\base\Model;

class KeteranganPermintaanForm extends Model
{

    public $keterangan;

    private $_permintaan;

    public function __construct($id, $config = [])
    {
        $this->_permintaan = PermintaanProduk::findOne($id);
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['keterangan', 'string'],
        ];
    }

    public function save($validation = true)
    {
        if ($validation) {
            $this->validate();
        }

        $this->_permintaan->keterangan = $this->keterangan;
        if ($this->_permintaan->save(false)) {
            return true;
        }

        return false;
    }
}
