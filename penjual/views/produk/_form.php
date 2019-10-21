<?php

use common\models\constants\FileExtension;
use dosamigos\tinymce\TinyMce;
use kartik\file\FileInput;
use kartik\number\NumberControl;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Produk */
/* @var $form ActiveForm; */
/* @var $galeriModel common\models\GaleriProduk */
/* @var $negoModel common\models\Nego */


?>


    <div class="produk-form">

        <?php $form = ActiveForm::begin(['id' => 'produk-form']); ?>

        <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'kategori')->widget(
            \dosamigos\selectize\SelectizeTextInput::className(),
            [
                'loadUrl' => ['produk/kategori-list'],
                'options' => ['class' => 'form-control'],
                'clientOptions' => [
                    'plugins' => ['remove_button'],
                    'valueField' => 'name',
                    'labelField' => 'name',
                    'searchField' => ['name'],
                ],
            ]
        )->hint('Use commas to separate tags') ?>
        <?= $form->field($model, 'deskripsi')->widget(TinyMce::class, []) ?>

        <?= $form->field($model, 'spesifikasi')->widget(TinyMce::class, []) ?>

        <?= $form->field($model, 'fitur')->widget(TinyMce::class, []) ?>

        <?= $form->field($model, 'harga')->widget(NumberControl::class, [
            'maskedInputOptions' => [
                'prefix' => 'Rp '
            ],

        ]) ?>
        <?= $form->field($model, 'nego')->checkbox() ?>

        <div class="nego d-none">
            <?= $form->field($negoModel, 'harga_satu')->widget(NumberControl::class, [
                'maskedInputOptions' => [
                    'prefix' => 'Rp '
                ]
            ]) ?>

            <?= $form->field($negoModel, 'harga_dua')->widget(NumberControl::class, [
                'maskedInputOptions' => [
                    'prefix' => 'Rp '
                ]
            ]) ?>

            <?= $form->field($negoModel, 'harga_tiga')->widget(NumberControl::class, [
                'maskedInputOptions' => [
                    'prefix' => 'Rp '
                ]
            ]) ?>
        </div>


        <?= $form->field($model, 'demo')->textInput() ?>

        <?= $form->field($model, 'manual')->widget(FileInput::class, [
            'pluginOptions' => [
                'theme' => 'explorer-fas',
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

        <?= $form->field($galeriModel, 'nama_berkas[]')->widget(FileInput::class, [
            'options' => [
                'multiple' => true
            ],
            'pluginOptions' => [
                'allowedFileExtensions' => FileExtension::FOTO,
                'showUpload' => false,
                'previewFileType' => 'image',
                'fileActionSettings' => [
                    'showZoom' => true,
                    'showRemove' => false,
                    'showUpload' => false,
                ],
            ]
        ])->label('Galeri Produk')->hint('Ukuran maksimal 5MB, jpeg/png') ?>

        <div class="form-group">
            <?= Html::submitButton('<i class=\'la la-save\'></i> Simpan', ['class' => 'btn btn-pill btn-elevate btn-elevate-air btn-brand']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php $js = <<<JS

$('#produk-nego').on('change',function() {
    var checked = $('#produk-nego').prop('checked');
    if(checked){
       $('.nego').removeClass('d-none');
    }
    else{
        $('.nego').addClass('d-none');
    }
});
 $('form').on('beforeSubmit', function()
    {
        var form = $(this);
        //console.log('before submit');

        var submit = form.find(':submit');
        KTApp.block('.modal',{
            overlayColor: '#000000',
            type: 'v2',
            state: 'primary',
            message: 'Sedang Memproses...'
        });
        submit.html('<i class="flaticon2-refresh"></i> Sedang Memproses');
        submit.prop('disabled', true);

        KTApp.blockPage({
            overlayColor: '#000000',
            type: 'v2',
            state: 'primary',
            message: 'Sedang memproses...'
        });

    });

JS;

$this->registerJs($js);
?>