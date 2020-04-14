<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\forms\setting\GantiPasswordForm */
/* @var $form ActiveForm */
?>
<div class="ganti_password_form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'oldPassword')->passwordInput() ?>
        <?= $form->field($model, 'newPassword')->passwordInput() ?>
        <?= $form->field($model, 'repeatPassword')->passwordInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn--round btn--md']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- _ganti_password_form -->
