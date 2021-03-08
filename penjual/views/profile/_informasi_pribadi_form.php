<?php

use common\models\constants\JenisKelamin;
use kartik\datecontrol\DateControl;
use kartik\datecontrol\Module;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\forms\setting\InformasiPribadiForm */
/* @var $form ActiveForm */
?>
<div class="informasi_pribadi_form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'email')->textInput() ?>
    <p class="text-danger">Jika mengubah email, harus melakukan verifikasi ulang.</p>
        <?= $form->field($model, 'nama_depan')->textInput() ?>
        <?= $form->field($model, 'nama_belakang')->textInput() ?>
        <?= $form->field($model, 'pekerjaan')->textInput() ?>
        <?= $form->field($model, 'tanggal_lahir')->widget(DateControl::class,[
            'type' => Module::FORMAT_DATE,
            'widgetOptions' => [
                'pluginOptions'=>['autoclose'=>true,'placeholder'=>'Tanggal Lahir']
            ]
        ]) ?>
        <?= $form->field($model, 'jenis_kelamin')->widget(Select2::class,[
            'data' => JenisKelamin::LIST,
            'pluginOptions' => [
                    'placeholder'=>'Pilih Jenis Kelamin'
            ]
        ]) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn--round btn--md']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- _informasi_pribadi_form -->
