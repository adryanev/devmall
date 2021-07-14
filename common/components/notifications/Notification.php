<?php


namespace common\components\notifications;

use common\components\notifications\components\PusherComponent;
use common\components\notifications\models\NotificationModel;
use common\components\notifications\models\NotificationReceive;
use common\components\notifications\storages\DatabaseStorage;
use common\components\notifications\storages\Storage;
use Yii;
use yii\di\Instance;

class Notification extends \yii\base\Component implements Notifiable
{

    public $entity_type_file = '@common\\components\\notifications\\config\\notification_entity_type.php';
    public $messageFile = '@common\\components\\notifications\\messages\\id-ID\\notification.php';

    private $storage = DatabaseStorage::class;
    private $pusher;
    private $entityType;
    private $messages;
    public function init()
    {
        parent::init();
        $this->storage = Instance::ensure($this->storage, Storage::class);
        $this->pusher = Yii::createObject(PusherComponent::class, [
            'appId' => Yii::$app->params['pusher.app_id'],
            'appKey' => Yii::$app->params['pusher.key'],
            'appSecret' => Yii::$app->params['pusher.secret'],
            'options' => [
                'cluster' => Yii::$app->params['pusher.cluster'],
                'useTLS' => true
            ],
        ]);
        $this->entityType = require $this->entity_type_file;
    }

    function sendMessage($actor, $notifier, $message)
    {

        // TODO: Implement sendMessage() method.
    }

    public function readNotification(NotificationReceive $notificationReceive){
        $this->storage->readNotification($notificationReceive);
    }

   private function buildMessage(NotificationReceive $notificationReceive)
    {
        $notificationModel = new NotificationModel();
        $notificationObject = $notificationReceive->notificationObject;
        $currentEntityType = $this->entityType[$notificationObject->entity_type_id];
        $currentEntityId = $notificationObject->entity_id;
        $sender = $notificationObject->notificationSend->actor;

        $entityType = $this->messages[$notificationObject->entity_type_id]['messageProp'];
        $notificationModel->id = $notificationReceive->id;
        $notificationModel->message = Yii::t('notification',$entityType,['user'=>$sender->username]);

    }
}
