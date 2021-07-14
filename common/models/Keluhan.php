<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "keluhan".
 *
 * @property int $id
 * @property int|null $id_user
 * @property int|null $id_produk
 * @property string|null $judul
 * @property string|null $deskripsi
 * @property string|null $dokumen
 * @property int|null $is_installed
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Produk $produk
 * @property User $user
 * @property string $statusString
 */
class Keluhan extends \yii\db\ActiveRecord
{
    const STATUS_DIKIRIM = 1;
    const STATUS_DIPROSES = 2;
    const STATUS_DITOLAK = 3;

    public function getStatusString(){
        $statuses = [self::STATUS_DIKIRIM => 'Dikirim',
            self::STATUS_DIPROSES=>'Diproses',
            self::STATUS_DITOLAK=>'Ditolak'];

        return $statuses[$this->status];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'keluhan';
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
    public function rules()
    {
        return [
            [['id_user', 'id_produk', 'is_installed', 'status', 'created_at', 'updated_at'], 'integer'],
            [['judul', 'deskripsi', 'dokumen'], 'string', 'max' => 255],
            [['judul','deskripsi','is_installed'],'required'],
            [['id_produk'], 'exist', 'skipOnError' => true, 'targetClass' => Produk::className(), 'targetAttribute' => ['id_produk' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_produk' => 'Id Produk',
            'judul' => 'Judul',
            'deskripsi' => 'Deskripsi',
            'dokumen' => 'Dokumen',
            'is_installed' => 'Is Installed',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Produk]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduk()
    {
        return $this->hasOne(Produk::className(), ['id' => 'id_produk']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
