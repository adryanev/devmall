<?php

namespace common\components\notifications\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "notification_receive".
 *
 * @property int $id
 * @property int|null $notification_object_id
 * @property int|null $notifier_id
 * @property int|null $status
 *
 * @property NotificationObject $notificationObject
 * @property User $notifier
 */
class NotificationReceive extends \yii\db\ActiveRecord
{
    const STATUS_READ = 1;
    const STATUS_UNREAD = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification_receive';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['notification_object_id', 'notifier_id', 'status'], 'integer'],
            [['notification_object_id'], 'exist', 'skipOnError' => true, 'targetClass' => NotificationObject::className(), 'targetAttribute' => ['notification_object_id' => 'id']],
            [['notifier_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['notifier_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'notification_object_id' => 'Notification Object ID',
            'notifier_id' => 'Notifier ID',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[NotificationObject]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotificationObject()
    {
        return $this->hasOne(NotificationObject::className(), ['id' => 'notification_object_id']);
    }

    /**
     * Gets query for [[Notifier]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifier()
    {
        return $this->hasOne(User::className(), ['id' => 'notifier_id']);
    }
}
