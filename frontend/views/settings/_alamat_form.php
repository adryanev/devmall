<?php

use frontend\models\forms\setting\AlamatForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model AlamatForm */
/* @var $form ActiveForm */
?>
<div class="alamat_form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alamat1')->textInput() ?>
    <?= $form->field($model, 'alamat2')->textInput() ?>

    <?= $form->field($model,'provinsi')->dropDownList($dataProvinsi, ['id'=>'id_provinsi']) ?>

     <?= $form->field($model,'kota')->widget(DepDrop::classname(),[
        'data' => [2 => '333'],
        'options'=>['id'=>'id_kota'],
        'pluginOptions'=>[
            'depends'=>['id_provinsi'],
            'placeholder'=>'Select...',
            'url'=>Url::to(['/settings/get-kota'])
        ]        
    ]); ?>


    <?= $form->field($model,'kecamatan')->widget(DepDrop::classname(),[
        'options'=>['id'=>'id_kecamatan'],
        'pluginOptions'=>[
            'depends'=>['id_kota'],
            'placeholder'=>'Select...',
            'url'=>Url::to(['/settings/get-kecamatan'])
        ]        
    ]); ?>

    <?= $form->field($model,'kelurahan')->widget(DepDrop::classname(),[
        'options'=>['id'=>'id_kelurahan'],
        'pluginOptions'=>[
            'depends'=>['id_kecamatan'],
            'placeholder'=>'Select...',
            'url'=>Url::to(['/settings/get-kelurahan'])
        ]        
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn--round btn--md']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- _ganti_password_form -->
