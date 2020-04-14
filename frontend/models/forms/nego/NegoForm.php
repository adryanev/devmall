<?php


namespace frontend\models\forms\nego;


use common\models\HargaNego;
use common\models\Model;
use common\models\Produk;
use Yii;
use yii\base\InvalidArgumentException;

class NegoForm extends Model
{

    public $harga;
    public $produk;
    private $_produk;

    public function __construct($id, $config = [])
    {
        $this->_produk = Produk::findOne($id);
        if (!$this->_produk) {
            throw new InvalidArgumentException('Data yang anda cari tidak ditemukan');
        }
        $this->produk = $this->_produk;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['produk', 'harga'], 'required'],
            [['harga', 'produk'], 'integer'],
            ['harga', 'cekHarga']
        ];
    }

    public function cekHarga($attribute, $params)
    {
        $nego = $this->_produk->nego0;

        if ($attribute < $nego->harga_tiga) {
            $this->addError($attribute, 'Gimana kalau ngasih ' . Yii::$app->formatter->asCurrency($nego->harga_satu) . ' gimana gan?');
        }
    }

    public function simpanHarga()
    {
        if (!$this->validate()) {
            return false;
        }
        $hargaNego = new HargaNego();
        $hargaNego->id_user = Yii::$app->user->identity->id;
        $hargaNego->id_produk = $this->_produk->id;
        $hargaNego->harga = $this->harga;

        return $hargaNego->save() ? $hargaNego : false;
    }
}