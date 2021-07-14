<?php
/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 */
$this->title = 'Cicilan';
$this->params['breadcrumbs'][]= ['label'=>$this->title];
?>
<section class="section--padding">
    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="mb-4"><?=$this->title?></h3>

                    <?=\yii\grid\GridView::widget([
                        'dataProvider' => $dataProvider,
                        'summary' => false,
                        'columns' => [
                            ['class'=>\yii\grid\SerialColumn::class,'header' => 'No'],
                            'transaksi.code',
                            'jumlah_cicilan:currency',
                            'banyak_cicilan',
                            'statusString',
                            ['class'=>\common\widgets\ActionColumn::class,'header'=>'Aksi',
                                'template' => '{view}'],
                        ]
                    ])?>
                </div>
            </div>
        </div>
    </div>
</section>
