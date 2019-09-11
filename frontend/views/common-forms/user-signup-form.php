<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\forms\user\UserSignupForm */
/* @var $form ActiveForm */
?>
<div class="user-signup-form">

    <?php $form = ActiveForm::begin(['action' => ['site/signup']]); ?>

        <?= $form->field($model, 'username')->textInput() ?>
        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'nama_depan')->textInput() ?>
        <?= $form->field($model, 'nama_belakang')->textInput() ?>
        <?= $form->field($model, 'agreement',['template'=>'{input}{label}{error}'])->checkbox()->label(' Saya setuju dengan '.Html::a('Terms of Service',['site/tos']).' di Website ini.') ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- user-signup-form -->
