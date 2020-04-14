<?php
/**
 * @var $this yii\web\View
 * @var $model yii\base\DynamicModel
 * @var $permintaan common\models\PermintaanProduk
 * @var $transaksi common\models\TransaksiPermintaan
 */

$this->title = 'Minta bayaran';
$this->params['breadcrumbs'][] = ['label'=>'Permintaan','url'=>['index']];
$this->params['breadcrumbs'][] = ['label'=>$permintaan->nama,'url'=>['view','id'=>$permintaan->id]];
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
                        <?=\yii\helpers\Html::encode($this->title)?>
                    </h3>
                </div>

            </div>

            <div class="kt-portlet__body">
                <div class="form-minta-bayar">
                    <?=$this->render('_form-minta-bayar',compact('model'))?>
                </div>

            </div>
        </div>
    </div>
</div>

