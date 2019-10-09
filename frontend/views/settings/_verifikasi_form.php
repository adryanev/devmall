<?php

use borales\extensions\phoneInput\PhoneInput;
use common\models\constants\FileExtension;
use common\models\VerifikasiUser;
use frontend\models\forms\setting\VerifikasiForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model VerifikasiForm */
/* @var $form ActiveForm */
/* @var $verifikasiSekarang VerifikasiUser */
?>

<div class="row">
    <div class="col-lg-12">
        <p>Silahkan unggah ktp anda.</p>
        <?php if(!empty($verifikasiSekarang)): ?>
        <h5 class="text-capitalize">Status Verifikasi Saat Ini</h5>
        <div class="table-responsive">
            <table class="table withdraw__table">
                <thead>
                <tr>
                    <th>Berkas</th>
                    <th>Status</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td><?= Html::img('@web/upload/verifikasi/'.$verifikasiSekarang->nama_file,['width'=>'50%']) ?></td>
                    <td class="bold"><?=$verifikasiSekarang->getStatusVerifikasi()?></td>
                </tr>
                </tbody>
            </table>
    </div>
        <?php
         endif;
        ?>
</div>
    <?php
    if(empty($verifikasiSekarang)) :
        ?>
        <div class="verifikasi_nomor_hp_form">

            <?php $form = ActiveForm::begin(); ?>



            <?= $form->field($model, 'berkas')->widget(
                \kartik\file\FileInput::class,[
                    'pluginOptions' => [
                        'theme' => 'explorer-fas',
                        'allowedFileExtensions' => FileExtension::FOTO,
                        'showUpload' => false,
                        'previewFileType' => 'any',
                        'fileActionSettings' => [
                            'showZoom' => true,
                            'showRemove' => false,
                            'showUpload' => false,
                        ],
                    ]
                ]
            ) ?>

            <div class="form-group">
                <?= Html::submitButton('Simpan', ['class' => 'btn btn--round btn--md']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div><!-- _ganti_password_form -->

        <?php elseif (
            !$verifikasiSekarang->status === VerifikasiUser::STATUS_DIKIRIM || !$verifikasiSekarang->status === VerifikasiUser::STATUS_DITERIMA): ?>
    <div class="verifikasi_nomor_hp_form">

        <?php $form = ActiveForm::begin(); ?>



        <?= $form->field($model, 'berkas')->widget(
            \kartik\file\FileInput::class,[
                'pluginOptions' => [
                    'theme' => 'explorer-fas',
                    'allowedFileExtensions' => FileExtension::FOTO,
                    'showUpload' => false,
                    'previewFileType' => 'any',
                    'fileActionSettings' => [
                        'showZoom' => true,
                        'showRemove' => false,
                        'showUpload' => false,
                    ],
                ]
            ]
        ) ?>

        <div class="form-group">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn--round btn--md']) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div><!-- _ganti_password_form -->

    <?php endif;?>
