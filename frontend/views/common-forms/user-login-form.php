<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\forms\user\UserLoginForm */
/* @var $form ActiveForm */
?>
<div class="user-login-form">

    <?php $form = ActiveForm::begin(['action' => ['site/login']]); ?>

        <?= $form->field($model, 'username')->textInput() ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'rememberMe')->checkbox()->label('Ingat Saya?') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Masuk   ', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- user-login-form -->
