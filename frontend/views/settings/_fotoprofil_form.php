<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\forms\setting\FotoProfilForm */
/* @var $form ActiveForm */
?>
<div class="fotoprofil_form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'avatar') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- _fotoprofil_form -->
