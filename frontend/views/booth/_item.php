<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 11/5/2019
 * Time: 6:31 PM
 */

use common\models\Booth;
use yii\bootstrap4\Html;

/**
 * @var $model Booth
 */
?>

<div class="single_speaker">
    <div class="speaker__thumbnail">
        <?= \yii\helpers\Html::img('@.penjual/upload/verifikasi/' . $model->avatar, ['height' => 250]) ?>
    </div>

    <div class="speaker__detail">
        <h2><?= $model->nama ?></h2>
        <hr>
        <span class="ocuup"><i
                    class="far fa-calendar-alt"></i> <?= Yii::$app->formatter->asDate($model->created_at) ?><br>
        <i class="fas fa-map-marker-alt"></i> <?= $model->kota ?></span>

        <?= \yii\helpers\StringHelper::truncateWords($model->deskripsi, 50, '...', true) ?>

        <div class="speaker_social">
            <?= Html::a('Lihat Detail', ['booth/view', 'id' => $model->id], ['class' => 'btn btn-md btn--round btn-primary']) ?>
        </div>
    </div>
</div>
