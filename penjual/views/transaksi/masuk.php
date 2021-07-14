<?php
/**
 * @var $this yii\web\View
 * @var $booth common\models\Booth
 * @var $transaksiDataProvider yii\data\ActiveDataProvider
 */

$this->title = 'Transaksi Masuk';
$this->params['breadcrumbs'][]= ['label'=>$this->title]
?>

<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                <?=$this->title?>
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <?=\kartik\grid\GridView::widget([
            'dataProvider' => $transaksiDataProvider,
            'summary' => false,
            'columns' => [
                ['class'=>\kartik\grid\SerialColumn::class,'header' => 'No'],
               'code',
               'order_date:datetime',
               'grand_total:currency',
               'paymentStatus',
               'statusTransaksi',
                ['class'=>\common\widgets\ActionColumn::class,'header' => 'Aksi',
                    'template' => '{view}']
            ]
        ])?>

    </div>
</div>
