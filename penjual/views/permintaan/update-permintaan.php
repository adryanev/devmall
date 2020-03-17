<?php

/**
 * @var $this yii\web\View
 * @var $model yii\base\DynamicModel
 * @var $permintaan common\models\PermintaanProduk
 */

$this->title = 'Update Permintaan Pembayaran';
$this->params['breadcrumbs'][] = ['label'=>'Permintaan', 'url'=>['permintaan/index']];
$this->params['breadcrumbs'][] = ['label'=>$permintaan->nama, 'url'=>['permintaan/view','id'=>$permintaan->id]];
$this->params['breadcrumbs'][] = ['label'=>$this->title];
?>

<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon2-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                       Update Permintaan Pembayaran
                    </h3>
                </div>

            </div>

            <div class="kt-portlet__body">
                <div class="tambahprogress-form">
                    <?=$this->render('_form-minta-bayar', ['model'=>$model,'permintaan'=>$permintaan])?>
                </div>

            </div>
        </div>
    </div>
</div>
