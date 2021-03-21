<?php

/**
 * @var $this yii\web\View
 * @var $model common\models\TransaksiCicilan
 */
$this->title = $model->transaksi->code;
$this->params['breadcrumbs'][] = ['label'=>'Cicilan','url'=>['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<section class="section--padding">
    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php if($model->status !== \common\models\TransaksiCicilan::STATUS_LUNAS):?>
                    <?=\yii\bootstrap4\Html::a('<span class="lnr lnr-cart"></span> Bayar Cicilan',['pembayaran/cicilan'],['class'=>'btn btn--icon btn-md btn--round btn-success float-right','data'=>[
                        'method'=>'POST',
                        'confirm'=>'Apakah anda ingin membayar cicilan ini?',
                        'params'=>['id'=>$model->id]
                    ]])?>
                    <?php endif;?>
                    <h3 class="mb-4"><?= $this->title ?></h3>

                    <?= \yii\widgets\DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            ['attribute'=>'transaksi.code',
                                'format'=>'raw',
                                'value'=>function($model){
                                    return \yii\bootstrap4\Html::a($model->transaksi->code,['pembelian/view','id'=>$model->transaksi->id]);
                                }],
                            'tanggal_jatuh_tempo:date',
                            'jumlah_cicilan:currency',
                            'banyak_cicilan',
                            'statusString',
                        ]
                    ]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h3 class="mb-4">Riwayat Pembayaran</h3>
                    <?=\yii\grid\GridView::widget([
                        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getPembayaranCicilans()]),
                        'summary' => false,
                        'columns' => [
                            ['class'=>\yii\grid\SerialColumn::class,'header' => 'No'],
                                'code',
                                'tanggal_pembayaran:datetime',
                                'jumlah_dibayar:currency',
'paymentStatusString'

//                            'transaksi.code',
//                            'tanggal_jatuh_tempo:date',
//                            'jumlah_cicilan:currency',
//                            'banyak_cicilan',
//                            'statusString',
//                            ['class'=>\common\widgets\ActionColumn::class,'header'=>'Aksi',
//                                'template' => '{view}'],
                        ]
                    ])?>
                </div>
            </div>
        </div>
    </div>
</section>
