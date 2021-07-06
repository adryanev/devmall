<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Keluhan */
/* @var $uploadModel \frontend\models\forms\KeluhanUploadForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="keluhan-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'judul')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deskripsi')->widget(\dosamigos\tinymce\TinyMce::className()) ?>

    <?= $form->field($uploadModel, 'dokumen')->widget(FileInput::class) ?>

    <?= $form->field($model, 'is_installed')->checkbox([
        'label'=>'Aplikasi Sudah terinstall dan dapat dijalankan?'
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-round btn-md']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
