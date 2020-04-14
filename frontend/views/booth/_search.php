<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BoothSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="booth-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nama')->label('Cari Penjual') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn btn-sm btn--round']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn--round btn--bordered btn-sm btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
