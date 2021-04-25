<?php


namespace common\components\notifications\storages;


use common\components\notifications\models\NotificationReceive;
use common\models\User;
use yii\base\BaseObject;

abstract class Storage extends BaseObject
{

    abstract function getUserNotification(User $user, bool $inculdeRead = false);
    abstract function readNotification(NotificationReceive $notification);
    abstract function unreadNotification(NotificationReceive $notification);
    abstract function readAllNotification(User $user);
}
