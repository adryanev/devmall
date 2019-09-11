<?php

namespace common\models;

use Yii;
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['nama', 'deskripsi'], 'string', 'max' => 255],
            [['nama'], 'unique'],
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
}
