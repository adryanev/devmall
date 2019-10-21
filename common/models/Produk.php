<?php

namespace common\models;

use dosamigos\taggable\Taggable;
use yii\behaviors\TimestampBehavior;

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
 *
 * @property Favorit[] $favorits
 * @property GaleriProduk[] $galeriProduks
 * @property KategoriProduk[] $kategoriProduks
 * @property Nego $nego0
 * @property Booth $booth
 * @property PromoProduk[] $promoProduks
 * @property Ulasan[] $ulasans
 */
class Produk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produk';
    }

    public function behaviors()
    {
        return
            [
                TimestampBehavior::class,
                ['class' => Taggable::class,
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
            [['deskripsi', 'spesifikasi', 'fitur'], 'required'],
            [['deskripsi', 'spesifikasi', 'fitur'], 'string'],
            [['nama', 'demo', 'manual'], 'string', 'max' => 255],
            [['id_booth'], 'unique'],
            [['id_produk'], 'exist', 'skipOnError' => true, 'targetClass' => Booth::className(), 'targetAttribute' => ['id' => 'id']],
            ['kategori', 'safe']
        ];
    }

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
        ];
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
        return $this->hasMany(Kategori::class, ['id' => 'id_kategori'])->viaTable(KategoriProduk::tableName(), ['id_produk' => 'id']);
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
        return $this->hasOne(Booth::className(), ['id_booth' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromoProduks()
    {
        return $this->hasMany(PromoProduk::className(), ['id_produk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUlasans()
    {
        return $this->hasMany(Ulasan::className(), ['id_produk' => 'id']);
    }
}
