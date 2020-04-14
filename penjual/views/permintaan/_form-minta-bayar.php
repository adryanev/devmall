<?php
/**
 * @var $this yii\web\View
 * @var $model yii\base\DynamicModel
 * @var $permintaan common\models\PermintaanProduk
 */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$action = !isset($model->nominal) ? ['permintaan/minta-bayar','id'=>$permintaan->id] : ['permintaan/update-permintaan-bayar','id'=>$model->id];
?>

<div class="form-minta-bayar">
    <?php $form = ActiveForm::begin(['id' => 'minta-bayar-form','action' => $action])
    ?>
    <?=$form->field($model,'id')->hiddenInput()->label(false)?>
    <?=$form->field($model,'nominal')->textInput(['type'=>'number'])?>
    <div class="form-group">
        <?= Html::submitButton('Simpan',['class'=>'btn btn-round btn-elevate btn-elevate-air btn-primary'])?>
    </div>
    <?php ActiveForm::end() ?>
</div>
