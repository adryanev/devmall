<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profil_user".
 *
 * @property int $id
 * @property int $id_user
 * @property string $nama_depan
 * @property string $nama_belakang
 * @property int $tanggal_lahir
 * @property int $jenis_kelamin
 * @property string $avatar
 * @property string $alamat1
 * @property string $alamat2
 * @property string $kelurahan
 * @property string $kecamatan
 * @property string $kota
 * @property string $provinsi
 * @property string $pekerjaan
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 */
class ProfilUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profil_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'tanggal_lahir', 'jenis_kelamin', 'created_at', 'updated_at'], 'integer'],
            [['nama_depan', 'nama_belakang', 'pekerjaan'], 'string', 'max' => 20],
            [['avatar'], 'string', 'max' => 255],
            [['alamat1', 'alamat2'], 'string', 'max' => 100],
            [['kelurahan', 'kecamatan', 'kota', 'provinsi'], 'string', 'max' => 50],
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
            'nama_depan' => 'Nama Depan',
            'nama_belakang' => 'Nama Belakang',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'avatar' => 'Avatar',
            'alamat1' => 'Alamat1',
            'alamat2' => 'Alamat2',
            'kelurahan' => 'Kelurahan',
            'kecamatan' => 'Kecamatan',
            'kota' => 'Kota',
            'provinsi' => 'Provinsi',
            'pekerjaan' => 'Pekerjaan',
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
