<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Ulasan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ulasan-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'nilai')->widget(\kartik\rating\StarRating::class, [
        'pluginOptions' => [
            'theme' => 'krajee-svg',
            'filledStar' => '<span class="krajee-icon krajee-icon-star"></span>',
            'emptyStar' => '<span class="krajee-icon krajee-icon-star"></span>'
        ]
    ]) ?>

    <?php echo froala\froalaeditor\FroalaEditorWidget::widget([
        'model' => $model,
        'attribute' => 'komentar',
        'options' => [
            // html attributes
            'id' => 'content'
        ],
        'clientOptions' => [
            'toolbarInline' => false,
            'theme' => 'royal', //optional: dark, red, gray, royal
            'language' => 'id' // optional: ar, bs, cs, da, de, en_ca, en_gb, en_us ...
        ],
        'clientPlugins' => ['fullscreen', 'paragraph_format', 'image']

    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn--round btn--md btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
