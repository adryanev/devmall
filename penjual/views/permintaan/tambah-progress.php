<?php

/**
 * @var $this yii\web\View
 * @var $model penjual\models\forms\ProgressPermintaanForm
 * @var $permintaan common\models\PermintaanProduk
 */

$this->title = 'Tambah Progress Permintaan';
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
                        Progress
                    </h3>
                </div>

            </div>

            <div class="kt-portlet__body">
                <div class="tambahprogress-form">
                    <?=$this->render('_form-progress', ['model'=>$model,'permintaan'=>$permintaan])?>
                </div>

            </div>
        </div>
    </div>
</div>
