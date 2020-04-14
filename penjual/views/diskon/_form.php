<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Diskon */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $dataProduk [] */
?>


    <div class="diskon-form">

        <?php $form = ActiveForm::begin(['id' => 'diskon-form']); ?>

        <?= $form->field($model, 'id_produk')->widget(\kartik\select2\Select2::class, [
            'data' => $dataProduk,
            'pluginOptions' => [
                'placeholder' => 'Pilih Produk'
            ]
        ])->label('Produk') ?>

        <?= $form->field($model, 'persentase')->textInput(['type' => 'number']) ?>

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