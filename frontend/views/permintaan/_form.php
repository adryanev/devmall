<?php

/**
 * @var $this yii\web\View
 * @var $model common\models\PermintaanProduk
 * @var $modelDetail frontend\models\forms\permintaan\PermintaanDetailUploadForm
 *
 */

use dosamigos\tinymce\TinyMce;
use kartik\datecontrol\DateControl;
use kartik\datecontrol\Module;
use common\models\constants\FileExtension;
use kartik\file\FileInput;
use kartik\grid\GridView;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;


?>
<div class="permintaan-produk-form">
    <?php $form = ActiveForm::begin(['id' => 'permintaan-produk-form']); ?>

    <?= $form->field($model, 'id_booth')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'nama')->textInput() ?>
    <?= $form->field($model, 'kriteria')->widget(TinyMce::class, []) ?>
    <?= $form->field($model, 'deadline')->widget(DateControl::class, [
        'type' => Module::FORMAT_DATE,
        'widgetOptions' => [
            'pluginOptions' => ['autoclose' => true, 'placeholder' => 'Tanggal Deadline', 'startDate' =>date('d-m-Y')]
        ]
    ]) ?>
    <?= $form->field($model, 'harga')->textInput(['type' => 'number']) ?>
    <?= $form->field($model, 'uang_muka')->textInput(['type' => 'number']) ?>
   
        <?= $form->field($modelDetail, 'uploadedFiles[]')->widget(FileInput::class, [
            'options' => [
                'multiple' => true
            ],
            'pluginOptions' => [
                'allowedFileExtensions' => FileExtension::DOKUMEN,
                'showUpload' => false,
                'previewFileType' => 'any',
                'fileActionSettings' => [
                    'showZoom' => true,
                    'showRemove' => false,
                    'showUpload' => false,
                ],
            ]
        ]) ?>




    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-lg btn--round']) ?>
    </div>

    <?php ActiveForm::end() ?>
</div>
