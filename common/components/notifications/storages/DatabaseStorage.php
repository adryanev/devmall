<?php


namespace common\components\notifications\storages;

use common\components\notifications\models\NotificationObject;
use common\components\notifications\models\NotificationReceive;
use common\components\notifications\Notification;
use common\models\User;
use yii\di\Instance;

class DatabaseStorage extends Storage
{

    /**
     * @param User $user
     * @param bool $inculdeRead
     *
     * @return NotificationReceive[]
     * get the user
     */
    function getUserNotification(User $user, bool $inculdeRead = false)
    {
        return $inculdeRead? $user->notifications: $user->getNotifications()->where(['status'=>NotificationReceive::STATUS_UNREAD])->all();

    }

    function readNotification(NotificationReceive $notification)
    {
        $notification->status = NotificationReceive::STATUS_READ;
        $notification->save(false);
    }

    function unreadNotification(NotificationReceive $notification)
    {
        $notification->status = NotificationReceive::STATUS_UNREAD;
        $notification->save(false);
    }

    function readAllNotification(User $user)
    {
        $notifications = $user->getNotifications()->andWhere(['status'=>NotificationReceive::STATUS_READ])->all();
        foreach ($notifications as $notification){
            $notification->status = NotificationReceive::STATUS_READ;
            $notification->save(false);
        }
    }
}
