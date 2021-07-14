<?php


namespace common\components\notifications;


use common\components\notifications\models\NotificationReceive;

interface Notifiable
{

    function sendMessage($actor,$notifier,$message);
}
