<?php

use frontend\models\forms\setting\AlamatForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model AlamatForm */
/* @var $form ActiveForm */
?>
<div class="ganti_password_form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alamat1')->textInput() ?>
    <?= $form->field($model, 'alamat2')->textInput() ?>
    <?= $form->field($model, 'kelurahan')->textInput() ?>
    <?= $form->field($model, 'kecamatan')->textInput() ?>
    <?= $form->field($model, 'kota')->textInput() ?>
    <?= $form->field($model, 'provinsi')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn--round btn--md']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- _ganti_password_form -->
