<?php
/**
 * @var $model \common\models\Ulasan
 * @var $key
 * @var $index
 * @var $widget
 */

?>

<div class="row mb-2">
    <div class="col-lg-3">
        <?=$model->user->username?>
    </div>
    <div class="col-lg-3">
        <?=$model->komentar?>
    </div>
    <div class="col-lg-3">
        <?=\kartik\rating\StarRating::widget([
            'name' => 'rating_'.$model->id,
            'value' => $model->nilai,
            'pluginOptions' => ['displayOnly' => true,        'size' => \kartik\rating\StarRating::SIZE_TINY,
            ]
        ])?>
    </div>
</div>
