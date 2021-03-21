<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\TransaksiProduk
 */

use yii\bootstrap4\Html;

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
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    <?php if ($model->status === \common\models\TransaksiProduk::STATUS_CONFIRMED) :
                       ?>
                    <?= Html::a('<i class="la la-paper-plane-o"></i> Kirim Produk', ['transaksi/kirim-produk'], ['class' => 'btn btn-success btn-elevate btn-elevate-air','data'=>[
                        'method'=>'POST',
                        'confirm'=>'Apakah anda ingin mengirimkan produk-produk ini ke pengguna?',
                        'params'=>['id'=>$model->id]
                    ]]) ?>
                    <?php endif?>

                </div>
            </div>
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

