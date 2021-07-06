<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "notifikasi".
 *
 * @property int $id
 * @property int $sender
 * @property int $receiver
 * @property string $context
 * @property int $id_data
 * @property string $jenis_data
  * @property string $status
 *
 */
class Notifikasi extends \yii\db\ActiveRecord
{
    const STATUS_NOT_READ = 'Belum Dibaca';
    const STATUS_READ = 'Sudah Dibaca';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notifikasi';
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
            [['id', 'sender', 'receiver', 'id_data', 'created_at', 'updated_at'], 'integer'],
            [['context', 'jenis_data', 'status'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data' => 'ID Data',
            'sender' => 'Pengirim',
            'receiver' => 'Penerima',
            'context' => 'Konteks',
            'jenis_data' => 'Jenis Data',
            'status' => 'Status'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'sender']);
    }


}
