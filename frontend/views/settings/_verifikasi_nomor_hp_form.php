<?php

use borales\extensions\phoneInput\PhoneInput;
use frontend\models\forms\setting\VerifikasiNomorHpForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model VerifikasiNomorHpForm*/
/* @var $form ActiveForm */

?>
<div class="verifikasi_nomor_hp_form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-8">
            <?= $form->field($model, 'nomor_hp')->widget(PhoneInput::class,[
                'jsOptions' => [
                    'onlyCountries'=>['id']
                ],
                'options' => ['placeholder'=>'62xxxxxxxxxxxx']
            ]) ?>

        </div>
<?php  
        if ($is_phone_verified) {
?>
            <span style="margin-left: 20px;">Nomor HP Ini Telah Diverifikasi</span>
<?php
        }
?>
        <div class="col-lg-4">
            <br>
            <br>
            <?=\yii\bootstrap4\Html::button('Verifikasi',['id'=>'nomor_hp-verification','class'=>'btn btn--sm btn--round'])?>
        </div>
    </div>

        <?= $form->field($model, 'kode_verifikasi')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn--round btn--md']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- _ganti_password_form -->

<?php
$url = Url::to(['settings/send-sms-verification']);
$js = <<<JS
    $('#nomor_hp-verification').on('click',function() {
        const nomorHp = $('#verifikasinomorhpform-nomor_hp').val();
        console.log(nomorHp);
        $.ajax({
            url: "$url",
            method: "POST",
            dataType: "JSON",
            data: {nomor: nomorHp},
            success: function(data) {
              console.log(data);
            }
        });
    })
JS;

$this->registerJs($js);

?>