<?php
/**
 * @var $model common\models\Produk
 */

use yii\bootstrap4\Html; ?>

    <div class="kt-pricing-1__visual">
        <div class="kt-pricing-1__hexagon1"></div>
        <div class="kt-pricing-1__hexagon2"></div>

        <span class="kt-pricing-1__icon kt-font-brand"><?= Html::img(Yii::getAlias('@.produkPath/' . $model->galeriProduks[0]->nama_berkas), ['width' => '100%']) ?></span>
    </div>
    <span class="kt-pricing-1__price"><?= \yii\helpers\StringHelper::mb_ucwords(Html::encode($model->nama)) ?></span>
    <h2 class="kt-pricing-1__subtitle"><?= Yii::$app->formatter->asCurrency($model->harga) ?></h2>
    <span class="kt-pricing-1__description">
													<?= $model->deskripsi ?>
												</span>
    <div class="kt-pricing-1__btn">
        <?= Html::a('<i class="la la-eye"></i> Lihat', ['produk/view', 'id' => $model->id], ['class' => 'btn btn-brand btn-custom btn-pill btn-wide btn-uppercase btn-bolder btn-sm']) ?>
    </div>
