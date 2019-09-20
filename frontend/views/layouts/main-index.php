<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\assets\martplace\MartplaceAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

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
    <title><?= Html::encode($this->title) ?> | DevMall</title>
    <?php $this->head() ?>
</head>
<body class="preload home1 mutlti-vendor">
<?php $this->beginBody() ?>

<?=$this->render('header',['searchModel'=>Yii::$app->view->params['searchModel']])?>
<?=$this->render('content',['content'=>$content])?>
<?=$this->render('footer')?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
