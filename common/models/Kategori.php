<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "kategori".
 *
 * @property int $id
 * @property string $nama
 * @property string $deskripsi
 * @property int $created_at
 * @property int $updated_at
 *
 * @property KategoriProduk[] $kategoriProduks
 * @property Produk[] $produks
 * @property int $frekuensi [int(11)]
 */
class Kategori extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kategori';
    }

    public static function findAllByName($name)
    {
        return self::find()->where(['like', 'nama', $name])
            ->all();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['nama', 'deskripsi'], 'string', 'max' => 255],
            [['nama'], 'unique'],
            [['nama'],'required']
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'deskripsi' => 'Deskripsi',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategoriProduks()
    {
        return $this->hasMany(KategoriProduk::className(), ['id_kategori' => 'id']);
    }

    public function getProduks()
    {
        return $this->hasMany(Produk::class, ['id' => 'id_kategori'])->viaTable(KategoriProduk::tableName(), ['id_kategori' => 'id']);
    }
}
