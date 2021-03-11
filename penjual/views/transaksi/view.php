<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\TransaksiProduk
 */
$this->title =$model->code;
$this->params['breadcrumbs'][]=['label'=>'Transaksi Masuk','url'=>['transaksi/masuk']];
$this->params['breadcrumbs'][]=['label'=>$this->title];
?>
<div class="kt-portlet">
    <div class="kt-portlet__head">

        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                <?=\yii\bootstrap4\Html::encode($this->title)?>
            </h3>
        </div>

    </div>
    <div class="kt-portlet__body">
        <?=
        \yii\widgets\DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'code',
                'order_date:datetime',
                'jenis_transaksi',
                'grand_total:currency'
            ]
        ])
        ?>
    </div>
</div>
<div class="kt-portlet">
    <div class="kt-portlet__body">
        <?=\kartik\grid\GridView::widget([
            'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getTransaksiDetails()]),
            'summary' => false,
            'columns' => [
                ['class'=>\kartik\grid\SerialColumn::class],
                'produk.nama',
                'base_price:currency',
                'bargain_price:currency',
                'discount_percent',
                'sub_total:currency',
            ]
        ])?>
    </div>
</div>

