<?php

use common\models\constants\FileExtension;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\forms\setting\FotoProfilForm */
/* @var $form ActiveForm */
?>
<div class="fotoprofil_form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

        <div class="row">
            <div class="col-lg-6">
                <p>Profil saat ini</p>
                <br>
                <?=Html::img('@.frontend/images/profil/'.Yii::$app->user->identity->profilUser->avatar,['height'=>80,'width'=>80])?>
            </div>
        </div>
    <br>


    <?= $form->field($model, 'avatar')->widget(FileInput::class,[
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
    ]) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn--md btn--round']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- _fotoprofil_form -->
