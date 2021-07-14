<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel penjual\models\ProdukSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
\common\assets\metronic\MetronicDashboardPricingAsset::register($this);
$colsCount = 4;

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
                    <div class="kt-pricing-1__items">
                        <?= \yii\widgets\ListView::widget([
                            'dataProvider' => $dataProvider,
                            'itemView' => '_items',
                            'summary' => false,
                            'itemOptions' => [
                                'class' => 'kt-pricing-1__item col-lg-3'

                            ],
                            'beforeItem' => function ($model, $key, $index, $widget) use ($colsCount) {
                                if ($index % $colsCount === 0) {
                                    return "<div class='row'>";
                                }
                                return '';
                            },
                            'afterItem' => function ($model, $key, $index, $widget) use ($colsCount) {
                                $content = '';
                                if (($index > 0) && ($index % $colsCount === $colsCount - 1)) {
                                    $content .= "</div>";
                                }
                                return $content;
                            },
                        ]);
                        if ($dataProvider->count % $colsCount !== 0) {
                            echo "</div>";
                        } ?>
                        <!-- end /.row -->

                    </div>
                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>


