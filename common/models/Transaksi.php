<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "transaksi".
 *
 * @property int $id
 * @property int $id_user
 * @property int $waktu
 * @property int $total
 * @property int $status
 * @property int $expire
 * @property string $metode_pembayaran
 * @property int $created_at
 * @property int $updated_at
 * @property string $jenis_transaksi
 * @property int $id_booth
 * @property string $kode_transaksi
 *
 * @property User $user
 * @property Booth $booth
 * @property TransaksiCicilan[] $transaksiCicilans
 * @property TransaksiDetail[] $transaksiDetails
 */
class Transaksi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksi';
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
            [['id_user', 'waktu', 'total', 'status', 'expire', 'created_at', 'updated_at', 'id_booth'], 'integer'],
            [['metode_pembayaran'], 'string', 'max' => 6],
            [['jenis_transaksi', 'kode_transaksi'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
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
            'id_user' => 'Id User',
            'waktu' => 'Waktu',
            'total' => 'Total',
            'status' => 'Status',
            'expire' => 'Expire',
            'metode_pembayaran' => 'Metode Pembayaran',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'jenis_transaksi' => 'Jenis Transaksi',
            'id_booth' => 'Id Booth',
            'kode_transaksi' => 'Kode Transaksi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
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
    public function getTransaksiCicilans()
    {
        return $this->hasMany(TransaksiCicilan::className(), ['id_transaksi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiDetails()
    {
        return $this->hasMany(TransaksiDetail::className(), ['id_transaksi' => 'id']);
    }
}
