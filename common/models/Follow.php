<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "follow".
 *
 * @property int $id
 * @property int $id_pengguna
 * @property int $id_booth
 * @property int $notification
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Booth $booth
 * @property User $pengguna
 */
class Follow extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'follow';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pengguna', 'id_booth', 'notification', 'created_at', 'updated_at'], 'integer'],
            [['id_booth'], 'exist', 'skipOnError' => true, 'targetClass' => Booth::className(), 'targetAttribute' => ['id_booth' => 'id']],
            [['id_pengguna'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_pengguna' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pengguna' => 'Id Pengguna',
            'id_booth' => 'Id Booth',
            'notification' => 'Notification',
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
    public function getPengguna()
    {
        return $this->hasOne(User::className(), ['id' => 'id_pengguna']);
    }
}
