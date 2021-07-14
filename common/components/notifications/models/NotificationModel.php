<?php


namespace common\components\notifications\models;

/**
 * Class NotificationModel
 * @package common\components\notifications\models
 *
 * @property $id
 * @property $picture
 * @property $sender
 * @property $message
 * @property $action
 * @property $status
 * @property $timestamp
 */
class NotificationModel extends \common\models\Model
{

    /**
     * @var NotificationReceive
     */
    private $_notificationReceive;

}
