<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelPromo common\models\Promo */
/* @var $modelsProduk common\models\PromoProduk */
/* @var $produkList common\models\Promo[] */


$this->title = 'Tambah Promo';
$this->params['breadcrumbs'][] = ['label' => 'Promo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12">

        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon2-add-1"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="promo-create">

                    <?= $this->render('_form', [
                        'modelPromo' => $modelPromo,
                        'modelsProduk' => $modelsProduk,
                        'modelsBooth' => $modelsBooth,
                        'produkList' => $produkList,
                        'boothList' => $boothList
                    ]) ?>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>

