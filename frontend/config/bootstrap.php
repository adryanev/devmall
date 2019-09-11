<?php

use frontend\models\forms\user\UserLoginForm;
use frontend\models\forms\user\UserSignupForm;
use yii\base\Event;
use yii\web\View;

Event::on(View::className(), View::EVENT_BEFORE_RENDER, function() {
    $modelSignup = new UserSignupForm();
    $modelLogin = new UserLoginForm();
    Yii::$app->view->params['modelSignup'] = $modelSignup;
    Yii::$app->view->params['modelLogin'] = $modelLogin;
});