<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "verifikasi_user".
 *
 * @property int $id
 * @property int $id_user
 * @property string $nama_file
 * @property string $jenis_verifikasi
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 */
class VerifikasiUser extends \yii\db\ActiveRecord
{
    const STATUS_DITERIMA = 2;
    const STATUS_DITOLAK = 0;
    const STATUS_DIKIRIM = 1;




    public function getStatusVerifikasi(){
        $status = [self::STATUS_DIKIRIM=>'Dikirim',self::STATUS_DITERIMA=>'Diterima',self::STATUS_DITOLAK=>'Ditolak'];
        return $status[$this->status];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'verifikasi_user';
    }

    public function behaviors()
    {
        return[
            TimestampBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'status', 'created_at', 'updated_at'], 'integer'],
            [['nama_file', 'jenis_verifikasi'], 'string', 'max' => 255],
            [['id_user'], 'unique'],
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
            'nama_file' => 'Nama File',
            'jenis_verifikasi' => 'Jenis Verifikasi',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
