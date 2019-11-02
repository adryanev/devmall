<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel penjual\models\ProdukSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
\common\assets\metronic\MetronicDashboardPricingAsset::register($this);

$this->title = 'Produk';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12">

        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon2-list-2"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <?= Html::a('<i class=flaticon2-add></i> Tambah Produk', ['create'], ['class' => 'btn btn-success btn-elevate btn-elevate-air']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-pricing-1">
                    <div class="kt-pricing-1__items row">
                        <?php foreach ($dataProvider->models as $model): ?>
                            <div class="kt-pricing-1__item col-lg-3">
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
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>


