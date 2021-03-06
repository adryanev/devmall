<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Diskon */
/* @var $dataProduk [] */

$this->title = 'Ubah Diskon: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Diskon', 'url' => ['index']];
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
                <div class="diskon-update">

                    <?= $this->render('_form', [
                        'model' => $model,
                        'dataProduk' => $dataProduk
                    ]) ?>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>



