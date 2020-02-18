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
            'pluginOptions' => ['autoclose' => true, 'placeholder' => 'Tanggal Deadline']
        ]
    ]) ?>
    <?= $form->field($model, 'harga')->textInput(['type' => 'number']) ?>
    <?= $form->field($model, 'uang_muka')->textInput(['type' => 'number']) ?>
    <?php if (!$model->isNewRecord): ?>
        <?= GridView::widget([
            'dataProvider' => new ActiveDataProvider(['query' => $dataDetail]),
            'summary' => false,
            'columns' => [
                ['class' => 'kartik\grid\SerialColumn', 'header' => 'No'],
                'nama_berkas',
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'header' => 'Aksi',
                    'template' => '{delete-file}',
                    'contentOptions' => ['class' => 'action'],
                    'buttons' => [
                        'delete-file' => function ($url, $model, $key) {
                            return Html::a(
                                '<i class="fas fa-trash"></i>',
                                ['permintaan/delete-file', 'id' => $model->id]
                            );
                        }
                    ]
                ]
            ]
        ]) ?>
    <?php endif; ?>
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
