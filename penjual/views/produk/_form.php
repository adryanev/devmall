<?php

use dosamigos\tinymce\TinyMce;
use kartik\file\FileInput;
use kartik\number\NumberControl;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Produk */
/* @var $form yii\bootstrap4\ActiveForm; */
/* @var $dataKategori */

?>


    <div class="produk-form">

        <?php $form = ActiveForm::begin(['id' => 'produk-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'kategori')->widget(Select2::class, [
            'data' => $dataKategori,
            'options' => [
                'multiple' => true
            ]
        ]) ?>
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
            <?= $form->field($model, 'harga_satu')->widget(NumberControl::class, [
                'maskedInputOptions' => [
                    'prefix' => 'Rp '
                ]
            ]) ?>

            <?= $form->field($model, 'harga_dua')->widget(NumberControl::class, [
                'maskedInputOptions' => [
                    'prefix' => 'Rp '
                ]
            ]) ?>

            <?= $form->field($model, 'harga_tiga')->widget(NumberControl::class, [
                'maskedInputOptions' => [
                    'prefix' => 'Rp '
                ]
            ]) ?>
        </div>


        <?= $form->field($model, 'demo')->textInput() ?>

        <?= $form->field($model, 'manual')->widget(FileInput::class, [

        ]) ?>

        <?= $form->field($model, 'galeri[]')->widget(FileInput::class, [
            'options' => [
                'multiple' => true
            ],
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('<i class=\'la la-save\'></i> Simpan', ['class' => 'btn btn-pill btn-elevate btn-elevate-air btn-brand']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php $js = <<<JS

$('#produkform-nego').on('change',function() {
    var checked = $('#produkform-nego').prop('checked');
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