<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Produk */
/* @var $galeriModel common\models\GaleriProduk */
/* @var $negoModel common\models\Nego */
/* @var $dataGaleri [] */

$this->title = 'Ubah Produk: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Produk', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>

<div class="row">
    <div class="col-lg-12">

        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon2-edit"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="produk-update">

                    <?= $this->render('_form', [
                        'model' => $model,
                        'negoModel' => $negoModel,
                        'galeriModel' => $galeriModel,
                        'dataGaleri' => $dataGaleri
                    ]) ?>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>



