<?php
/**
 * @var $this yii\web\View
 * @var $model penjual\models\forms\ReimbursementForm
 * @var $booth \common\models\Booth
 */

use yii\bootstrap4\ActiveForm;

?>
<div class="reimbursement-form">
    <?php $form = ActiveForm::begin(['id' => 'reimbursement-form','enableAjaxValidation' => true,'enableClientValidation'=>false])?>
    <?=$form->field($model,'bank')->textInput(['autofocus'=>true])?>
    <?=$form->field($model,'nomor_rekening')->textInput()?>
    <?=$form->field($model,'amount')->textInput()?>
    <div class="form-group">
        <?=\yii\bootstrap4\Html::submitButton('<i class=\'la la-save\'></i> Simpan',['class'=>'btn btn-primary btn-elevate btn-elevate-air pull-right'])?>
    </div>
    <?php ActiveForm::end()?>
</div>
