<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\forms\setting\GantiPasswordForm */
/* @var $form ActiveForm */


?>
<div class="ganti_password_form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($modelPassword, 'oldPassword')->passwordInput() ?>
        <?= $form->field($modelPassword, 'newPassword')->passwordInput() ?>
        <?= $form->field($modelPassword, 'repeatPassword')->passwordInput() ?>
    
        <div class="form-group">
        <?= Html::submitButton('<i class=\'la la-save\'></i> Simpan', ['class' => 'btn btn-pill btn-elevate btn-elevate-air btn-brand']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- _ganti_password_form -->
