<?php

namespace common\models;

use common\components\NegoTrait;
use common\components\shoppingcart\CartItemInterface;
use common\components\shoppingcart\CartItemTrait;
use dosamigos\taggable\Taggable;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "produk".
 *
 * @property int $id
 * @property int $id_booth
 * @property string $nama
 * @property string $deskripsi
 * @property string $spesifikasi
 * @property string $fitur
 * @property int $harga
 * @property string $demo
 * @property string $manual
 * @property int $nego
 * @property int $created_at
 * @property int $updated_at
 * @property string $download_link
 * @property string $video
 *
 * @property int hargaDiskon
 * @property Favorit[] $favorits
 * @property GaleriProduk[] $galeriProduks
 * @property KategoriProduk[] $kategoriProduk
 * @property Nego $nego0
 * @property Booth $booth
 * @property PromoProduk[] $promoProduks
 * @property Ulasan[] $ulasans
 * @property float $nilaiUlasan
 * @property Diskon $diskon
 */
class Produk extends \yii\db\ActiveRecord implements CartItemInterface
{
    use CartItemTrait, NegoTrait;

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_booth' => 'Id Booth',
            'nama' => 'Nama',
            'deskripsi' => 'Deskripsi',
            'spesifikasi' => 'Spesifikasi',
            'fitur' => 'Fitur',
            'harga' => 'Harga',
            'demo' => 'Demo',
            'manual' => 'Manual',
            'nego' => 'Nego',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'downlaoad_link' => 'Link Download',
        ];
    }

    public function behaviors()
    {
        return
            [
                TimestampBehavior::class,
                [
                    'class' => Taggable::class,
                    'attribute' => 'kategori',
                    'name' => 'nama',
                    'frequency' => 'frekuensi',
                    'relation' => 'kategoriProduk'
                ]
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_booth', 'harga', 'nego', 'created_at', 'updated_at'], 'integer'],
            [['deskripsi', 'spesifikasi', 'fitur', 'nama', 'kategori', 'harga', 'download_link'], 'required'],
            [['deskripsi', 'spesifikasi', 'fitur', 'download_link'], 'string'],
            [['nama', 'demo', 'manual', 'video'], 'string', 'max' => 255],
            ['video','filter','filter'=>[$this,'filterVideo'] ],
            [['id_booth'], 'unique'],
            [
                ['id_produk'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Booth::className(),
                'targetAttribute' => ['id' => 'id']
            ],
            [['kategori'], 'safe']
        ];
    }

    function filterVideo($value) {
        //get only the video id
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $value, $matches);
        var_dump($matches);
        exit();
        return trim($matches[1]);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produk';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavorits()
    {
        return $this->hasMany(Favorit::className(), ['id_produk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGaleriProduks()
    {
        return $this->hasMany(GaleriProduk::className(), ['id_produk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategoriProduk()
    {
        return $this->hasMany(Kategori::class, ['id' => 'id_kategori'])->viaTable(KategoriProduk::tableName(),
            ['id_produk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNego0()
    {
        return $this->hasOne(Nego::className(), ['id_produk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooth()
    {
        return $this->hasOne(Booth::className(), ['id' => 'id_booth']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromoProduks()
    {
        return $this->hasMany(PromoProduk::className(), ['id_produk' => 'id']);
    }

    public function getNilaiUlasan()
    {
        $ulasan = $this->ulasans;
        $totalUlasan = $this->getUlasans()->count();
        $mapUlasan = ArrayHelper::map($ulasan, 'nilai', 'nilai');
        $nilaiUlasan = array_sum($mapUlasan);
        $nilai = round(($nilaiUlasan / max($totalUlasan, 1)), 1);

        return $nilai;


    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUlasans()
    {
        return $this->hasMany(Ulasan::className(), ['id_produk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiskon()
    {
        return $this->hasOne(Diskon::class, ['id_produk' => 'id']);
    }

    public function getHargaNego()
    {
        return $this->hasOne(HargaNego::class, ['id_produk' => 'id']);
    }

    public function getHargaDiskon()
    {
        return $this->harga - round(($this->harga * ($this->diskon->persentase) / 100));
    }

    public function getTerjual($id_produk)
    {
        $command = Yii::$app->db
            ->createCommand("SELECT * FROM transaksi_detail WHERE id_produk='" . $id_produk . "'");
        return $command->execute();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPrice()
    {
        return $this->harga;
    }


}
