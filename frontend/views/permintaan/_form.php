<?php

/**
 * @var $this yii\web\View
 * @var $model common\models\PermintaanProduk
 * @var $modelDetail frontend\models\forms\permintaan\PermintaanDetailUploadForm
 *
 */

use kartik\datecontrol\DateControl;
use kartik\datecontrol\Module;
use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;


?>
<div class="permintaan-produk-form">
    <?php $form = ActiveForm::begin(['id' => 'permintaan-produk-form']); ?>

    <?= $form->field($model, 'id_booth')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'nama')->textInput() ?>
    <?= $form->field($model, 'kriteria')->widget(\dosamigos\tinymce\TinyMce::class, []) ?>
    <?= $form->field($model, 'deadline')->widget(DateControl::class, [
        'type' => Module::FORMAT_DATE,
        'widgetOptions' => [
            'pluginOptions' => ['autoclose' => true, 'placeholder' => 'Tanggal Deadline']
        ]
    ]) ?>
    <?= $form->field($model, 'harga')->textInput(['type' => 'number']) ?>
    <?= $form->field($model, 'uang_muka')->textInput(['type' => 'number']) ?>
    <?= $form->field($modelDetail, 'uploadedFiles[]')->widget(FileInput::class, [
        'options' => [
            'multiple' => true,
        ],
        'pluginOptions' => [
            'maxFileCount' => 5,
            'showPreview' => false,
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => false,
            'theme' => 'explorer-fas',
            'browseClass' => 'btn btn-primary btn-sm',
            'cancelClass' => 'btn btn-secondary btn-sm'
        ]
    ]) ?>
    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-lg btn--round']) ?>
    </div>

    <?php ActiveForm::end() ?>
</div>
