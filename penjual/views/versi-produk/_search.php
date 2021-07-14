<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model penjual\models\VersiProdukSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="versi-produk-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_produk') ?>

    <?= $form->field($model, 'link_lama') ?>

    <?= $form->field($model, 'link_baru') ?>

    <?= $form->field($model, 'catatan_perubahan') ?>

    <?php // echo $form->field($model, 'cara_instalasi') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
