<?php

use Carbon\Carbon;
use common\models\Config;
use frontend\models\forms\search\SearchProductForm;
use yii\base\Event;
use yii\helpers\ArrayHelper;
use yii\web\View;

Event::on(View::className(), View::EVENT_BEFORE_RENDER, function () {
    $modelSearch = new SearchProductForm();
    Yii::$app->view->params['searchModel'] = $modelSearch;

    $config = Config::find()->asArray()->all();
    $configArray = ArrayHelper::map($config,'key','value');
    Yii::$app->view->params['configApps'] = $configArray;
});

Carbon::setLocale('id');