<?php

/* @var $this \yii\web\View */

/* @var $content string */

use common\assets\martplace\MartplaceAsset;
use common\models\Config;
use kartik\growl\Growl;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


MartplaceAsset::register($this);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> - DevMall</title>
    <?php $this->head() ?>
</head>
<body class="preload">
<?php $this->beginBody() ?>
<?php foreach (Yii::$app->session->getAllFlashes() as $message): ?>
    <?php
    echo Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
        'showSeparator' => true,
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);
    ?>
<?php endforeach; ?>
<?= $this->render('header', ['searchModel' => Yii::$app->view->params['searchModel']]) ?>
<?= $this->render('breadcrumb') ?>
<?= $this->render('content', ['content' => $content]) ?>
<?= $this->render('footer') ?>
<?php $this->endBody() ?>
<?php
yii\bootstrap4\Modal::begin([
    'title' => '<span id="modalHeaderTitle"></span>',
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'modal',
    'size' => 'modal-lg',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]


]);
echo "<div id='modalContent'></div>";
yii\bootstrap4\Modal::end();
?>
</body>
</html>
<?php $this->endPage() ?>
