<?php

use Carbon\Carbon;
use frontend\models\forms\search\SearchProductForm;
use yii\base\Event;
use yii\web\View;

Event::on(View::className(), View::EVENT_BEFORE_RENDER, function () {
    $modelSearch = new SearchProductForm();
    Yii::$app->view->params['searchModel'] = $modelSearch;
});

Carbon::setLocale('id');