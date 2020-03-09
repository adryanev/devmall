<?php

/**
 * @var $this yii\web\View
 * @var $model penjual\models\forms\ProgressPermintaanForm
 * @var $permintaan common\models\PermintaanProduk
 */
$url = ['permintaan/tambah-progress','id'=>$permintaan->id];
if(!empty($model->tanggal) || !empty($model->keterangan)){
    $url = ['permintaan/update-progress','id'=>$model->getModel()->id];
}

use kartik\datecontrol\Module; ?>

<div class="form-progress">
    <?php $form = \yii\bootstrap4\ActiveForm::begin(['id'=>'progress-permintaan-form','action' => $url]) ?>
    <?= $form->field($model, 'id_permintaan')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'tanggal')->widget(\kartik\datecontrol\DateControl::class, [
        'type' => Module::FORMAT_DATE,
        'widgetOptions' => [
            'pluginOptions'=>['autoclose'=>true,'placeholder'=>'Tanggal Progress']
        ]
    ]) ?>
    <?=$form->field($model, 'keterangan')->textInput()?>
    <div class="form-group">
        <?=\yii\bootstrap4\Html::submitButton('Simpan', ['class'=>'btn btn-primary btn-round btn-elevate btn-elevate-air'])?>
    </div>
    <?php \yii\bootstrap4\ActiveForm::end() ?>
</div>

