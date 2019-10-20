<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 10/20/2019
 * Time: 2:52 PM
 */

namespace penjual\models\forms;


use Carbon\Carbon;
use common\models\constants\FileExtension;
use common\models\GaleriProduk;
use common\models\KategoriProduk;
use common\models\Nego;
use common\models\Produk;
use Yii;
use yii\base\Model;
use yii\db\Exception;
use yii\web\UploadedFile;

class ProdukForm extends Model
{

    public $nama;
    public $kategori;
    public $deskripsi;
    public $spesifikasi;
    public $fitur;
    public $harga;
    public $demo;
    public $harga_satu;
    public $harga_dua;
    public $harga_tiga;

    /** @var UploadedFile */
    public $manual;
    public $nego;

    /** @var UploadedFile[] */
    public $galeri;

    private $_booth;
    private $_produk;
    private $_nego;


    public function __construct($id = null, $config = [])
    {
        $this->_booth = Yii::$app->user->identity->booth;
        if ($id != null) {
            $this->_produk = Produk::findOne($id);
            $this->_nego = Nego::findOne($this->_produk->id);
            if ($this->_nego) {
                $this->nego = true;
            }
            $this->setAttributes($this->_produk->attributes);
            $this->setAttributes($this->_nego->attributes);
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['nama', 'deskripsi', 'harga', 'demo', 'fitur', 'manual', 'kategori'], 'required'],
            [['nama', 'deskripsi', 'fitur', 'spesifikasi'], 'string'],
            ['nego', 'boolean'],
            [['kategori'], 'integer'],
            [['harga', 'harga_satu', 'harga_dua', 'harga_tiga'], 'integer'],
            ['galeri', 'file', 'extensions' => FileExtension::FOTO],
            ['manual', 'file', 'extensions' => FileExtension::DOKUMEN],
            [['harga_satu', 'harga_dua', 'harga_tiga'], 'safe']

        ];
    }

    public function create()
    {
        $produk = new Produk();
        $produk->id_booth = $this->_booth->id;
        $produk->setAttributes($this->attributes);

        $transaction = Yii::$app->db->beginTransaction();
        $produk->save(false);
        foreach ($this->kategori as $k => $kategori) {
            $kategoriProduk = new KategoriProduk();
            $kategoriProduk->id_produk = $produk->id;
            $kategoriProduk->id_kategori = $k;
            $kategoriProduk->save(false);
        }
        if (!empty($this->nego)) {
            $nego = new Nego();
            $nego->setAttributes($this->attributes);
            $nego->id_produk = $produk->id;
            $nego->save(false);
        }
        if (!empty($this->galeri)) {
            foreach ($this->galeri as $file) {
                $timestamp = Carbon::now()->timestamp;
                $filename = $timestamp . '-' . $file->baseName . '.' . $file->extension;
                $galeri = new GaleriProduk();
                $galeri->id_produk = $produk->id;
                $galeri->nama_berkas = $filename;
                $galeri->jenis_berkas = $file->extension;
                $galeri->save(false);

            }
        }
        try {
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }

        return $produk;
    }

    public function update()
    {
        $this->_produk->setAttributes($this->attributes);
        $transaction = Yii::$app->db->beginTransaction();

        $this->_produk->save(false);

        if (!$this->nego) {
            $nego = $this->_nego;
            $nego->setAttributes($this->attributes);
            $nego->id_produk = $this->_produk->id;
            $nego->save(false);
        }
        if (!empty($this->galeri)) {
            foreach ($this->galeri as $item) {
                $timestamp = Carbon::now()->timestamp;
                $filename = $timestamp . '-' . $item->baseName . '.' . $item->extension;

                $galeri = new GaleriProduk();
                $galeri->id_produk = $this->_produk->id;
                $galeri->nama_berkas = $filename;
                $galeri->jenis_berkas = $item->extension;
                $galeri->save(false);
            }
        }

        try {
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
        return $this->_produk;
    }
}