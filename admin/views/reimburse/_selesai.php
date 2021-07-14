<?php
/**
 * @var $this yii\web\View
 * @var $model admin\models\ReimbursementCompletedForm
 */
?>
<div class="reimbursement-selesa-form">

    <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'reimbursement-selesai-form'])?>

    <?=$form->field($model,'bukti')->widget(\kartik\file\FileInput::class,[
        'pluginOptions' => [
            'theme'=>'explorer-fas',
            'showUpload'=>false,
            'previewFileType' => 'any',
            'fileActionSettings' => [
                'showZoom' => true,
                'showRemove' => false,
                'showUpload' => false,
            ],
            'allowedFileExtensions' =>['jpg','jpeg','png','bmp','gif'],
        ]
    ])?>
    <div class="form-group pull-right">
        <?=\yii\bootstrap4\Html::submitButton('<i class="la la-save"></i> Simpan',['class'=>'btn btn-primary btn-pill btn-elevate btn-elevate-air'])?>
    </div>

    <?php \yii\bootstrap4\ActiveForm::end() ?>
</div>
