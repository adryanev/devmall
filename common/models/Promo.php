<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "promo".
 *
 * @property int $id
 * @property int $id_booth
 * @property string $promo
 * @property double $persentase
 * @property int $waktu_mulai
 * @property int $waktu_selesai
 * @property string $kode_promo
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Booth $booth
 * @property PromoProduk[] $promoProduks
 * @property Produk[] $produksInPromo
 */
class Promo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promo';
    }

    public function behaviors()
    {
        return [TimestampBehavior::class];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_booth', 'waktu_mulai', 'waktu_selesai', 'created_at', 'updated_at'], 'integer'],
            [['persentase'], 'number'],
            [['promo'], 'string', 'max' => 255],
            [['kode_promo'], 'string', 'max' => 20],
            [['id_booth'], 'exist', 'skipOnError' => true, 'targetClass' => Booth::className(), 'targetAttribute' => ['id_booth' => 'id']],
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
            'promo' => 'Promo',
            'persentase' => 'Persentase',
            'waktu_mulai' => 'Waktu Mulai',
            'waktu_selesai' => 'Waktu Selesai',
            'kode_promo' => 'Kode Promo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
        return $this->hasMany(PromoProduk::className(), ['id_promo' => 'id']);
    }

    public function getProduksInPromo()
    {
        return $this->hasMany(Produk::class, ['id' => 'id_produk'])->viaTable(PromoProduk::tableName(), ['id_promo' => 'id']);
    }
}
