<?php

namespace common\components\notifications\models;

use Yii;

/**
 * This is the model class for table "notification_object".
 *
 * @property int $id
 * @property int|null $entity_id
 * @property int|null $entity_type_id
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property NotificationReceive[] $notificationReceives
 * @property NotificationSend $notificationSend
 */
class NotificationObject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification_object';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_id', 'entity_type_id', 'status', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_id' => 'Entity ID',
            'entity_type_id' => 'Entity Type ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[NotificationReceives]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotificationReceives()
    {
        return $this->hasMany(NotificationReceive::className(), ['notification_object_id' => 'id']);
    }

    /**
     * Gets query for [[NotificationSend]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotificationSend()
    {
        return $this->hasOne(NotificationSend::className(), ['notification_object_id' => 'id']);
    }
}
