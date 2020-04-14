<?php


namespace penjual\models\forms;

use common\models\RiwayatPermintaan;
use yii\base\Model;

/**
 * Class ProgressPermintaanForm
 * @package penjual\models\forms
 *
 */

class ProgressPermintaanForm extends Model
{

    public $id_permintaan;
    public $tanggal;
    public $keterangan;

    private $_model;

    public function __construct($id = 0, $config = [])
    {
        if($id !== 0){
            $this->_model = RiwayatPermintaan::findOne($id);
            $this->id_permintaan = $this->_model->id_permintaan_produk;
            $this->tanggal = $this->_model->tanggal;
            $this->keterangan = $this->_model->keterangan;
        }
    }

    /**
     * @return RiwayatPermintaan|null
     */
    public function getModel(): ?RiwayatPermintaan
    {
        return $this->_model;
    }

    public function rules()
    {
        return [
            [['id_permintaan','tanggal','keterangan'],'required'],
            [['id_permintaan','tanggal'],'integer'],
            ['keterangan','string']
        ];
    }

    public function save()
    {
        $model = new RiwayatPermintaan();
        $model->id_permintaan_produk = $this->id_permintaan;
        $model->tanggal = $this->tanggal;
        $model->keterangan = $this->keterangan;

        return $model->save(false)? $model : null;
    }

    public function update(){

        $this->_model->keterangan = $this->keterangan;
        $this->_model->tanggal = $this->tanggal;
        return $this->_model->update(false) ? $this->_model : null;
    }


}
