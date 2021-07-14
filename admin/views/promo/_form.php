<?php

use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use kidzen\dynamicform\DynamicFormWidget;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $modelPromo common\models\Promo */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $modelsProduk common\models\PromoProduk */
/* @var $produkList common\models\Promo[] */
?>


    <div class="promo-form">

        <?php $form = ActiveForm::begin(['id' => 'promo-form']); ?>

        <?= $form->field($modelPromo, 'promo')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelPromo, 'persentase')->textInput() ?>


        <?= $form->field($modelPromo, 'waktu_mulai')->widget(DateControl::class, [
            'widgetOptions' => [
                'pluginOptions' => ['startDate' => date('d-m-Y')]
            ]
        ]) ?>

        <?= $form->field($modelPromo, 'waktu_selesai')->widget(DateControl::class, [
            'widgetOptions' => [
                'pluginOptions' => ['startDate' => date('d-m-Y')]
            ]
        ]) ?>

        <?= $form->field($modelPromo, 'kode_promo')->textInput(['maxlength' => true]) ?>

        <div class="card">
            <div class="card-header">
                <h4><i class="la la-money"></i> Booth promo</h4>
            </div>

            <div class="card-body">
                <?php DynamicFormWidget::begin([
                    'id'=>'booth-form',
                    'widgetContainer' => 'dynamicform_wrapper',
                    'widgetBody' => '.container-items-booth',
                    'widgetItem' => '.item-booth',
                    'min' => 1,
                    'insertButton' => '.add-item-booth',
                    'deleteButton' => '.remove-item-booth',
                    'model' => $modelsBooth[0],
                    'formId' => 'promo-form',
                    'formFields' => [
                        'id_booth'
                    ]
                ]) ?>
                <div class="container-items-booth">
                    <?php

                    foreach ($modelsBooth as $i => $promoBooth): ?>
                        <div class="item-booth card">
                            <div class="card-header">
                                <h5 class="card-title pull-left">Booth</h5>
                                <div class="pull-right">
                                    <button type="button"
                                            class="add-item-booth btn btn-success btn-xs btn-pill btn-elevate btn-elevate-air">
                                        <i class="la la-plus"></i></button>
                                    <button type="button"
                                            class="remove-item-booth btn btn-danger btn-xs btn-pill btn-elevate btn-elevate-air">
                                        <i class="la la-minus"></i></button>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body">


                                <?php

                                if ($promoBooth->isNewRecord) {
                                    echo \yii\bootstrap4\Html::activeHiddenInput($promoBooth, "[{$i}]id");
                                }
                                ?>

                                <?= $form->field($promoBooth, "[{$i}]id_booth")->widget(Select2::class, ['data' => $boothList])
                                ?>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php DynamicFormWidget::end() ?>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4><i class="la la-money"></i> Produk-produk promo</h4>
            </div>

            <div class="card-body">
                <?php DynamicFormWidget::begin([
                    'id' => 'product-form',
                    'widgetContainer' => 'dynamicform_wrapper',
                    'widgetBody' => '.container-items-product',
                    'widgetItem' => '.item-product',
                    'min' => 1,
                    'insertButton' => '.add-item-product',
                    'deleteButton' => '.remove-item-product',
                    'model' => $modelsProduk[0],
                    'formId' => 'promo-form',
                    'formFields' => [
                        'id_produk'
                    ]
                ]) ?>
                <div class="container-items-product">
                    <?php

                    foreach ($modelsProduk as $i => $promoProduk): ?>
                        <div class="item-product card">
                            <div class="card-header">
                                <h5 class="card-title pull-left">Produk</h5>
                                <div class="pull-right">
                                    <button type="button"
                                            class="add-item-product btn btn-success btn-xs btn-pill btn-elevate btn-elevate-air">
                                        <i class="la la-plus"></i></button>
                                    <button type="button"
                                            class="remove-item-product btn btn-danger btn-xs btn-pill btn-elevate btn-elevate-air">
                                        <i class="la la-minus"></i></button>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body">


                                <?php


                                if ($promoProduk->isNewRecord) {
                                    echo \yii\bootstrap4\Html::activeHiddenInput($promoProduk, "[{$i}]id");
                                }
                                ?>

                                <?= $form->field($promoProduk, "[{$i}]id_produk")->widget(Select2::class, ['data' => $produkList])
                                ?>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php DynamicFormWidget::end() ?>
            </div>
        </div>


        <div class="form-group">
            <?= Html::submitButton('<i class=\'la la-save\'></i> Simpan', ['class' => 'btn btn-pill btn-elevate btn-elevate-air btn-brand']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php $js = <<<JS

$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
    if (! confirm("Apakah kamu ingin menghapus item ini?")) {
        return false;
    }
    return true;
});
JS;

$this->registerJs($js);
?>
