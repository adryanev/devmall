<?php

use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\VersiProduk */
/* @var $uploadModel \penjual\models\forms\VersiProdukUploadForm */
/* @var $form yii\bootstrap4\ActiveForm;
*/
?>


<div class="versi-produk-form">

    <?php $form = ActiveForm::begin(['id'=>'versi-produk-form']); ?>

    <?= $form->field($model, 'link_baru')->textInput(['maxlength' => true,'placeholder'=>'https://drive.google.com'])->hint("Sertakan https://") ?>

    <?= $form->field($model, 'catatan_perubahan')->widget(TinyMce::className()) ?>

    <?= $form->field($uploadModel, 'cara_instalasi')->widget(\kartik\file\FileInput::class) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class=\'la la-save\'></i> Simpan', ['class' => 'btn btn-pill btn-elevate btn-elevate-air btn-brand']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php $js = <<<JS
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
