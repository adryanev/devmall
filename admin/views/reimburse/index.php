<?php
/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $completeDataProvider yii\data\ActiveDataProvider
 */

$this->title = 'Reimbursement';
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>

<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                <?= \yii\bootstrap4\Html::encode($this->title) ?>
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">

        <?= \kartik\grid\GridView::widget([
            'summary' => false,
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => \kartik\grid\SerialColumn::class, 'header' => 'No'],
                'created_at:datetime',
                'booth.nama',
                'bank',
                'nomor_rekening',
                'amount:currency',
                'status',
                [
                    'class' => \common\widgets\ActionColumn::class,
                    'header' => 'Aksi',
                    'template' => '{view}',
                ]
            ]
        ]) ?>
    </div>
</div>
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
               Reimbursement Selesai
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">

        <?= \kartik\grid\GridView::widget([
            'summary' => false,
            'dataProvider' => $completeDataProvider,
            'columns' => [
                ['class' => \kartik\grid\SerialColumn::class, 'header' => 'No'],
                'created_at:datetime',
                'booth.nama',
                'bank',
                'nomor_rekening',
                'amount:currency',
                'status',
                ['attribute' => 'bukti','format' => ['image',['width'=>'100px','height'=>'100px']],
                    'value'=>function($model){
                        if($model->bukti){
                            return Yii::getAlias('@.reimbursementPath/').$model->bukti;
                        }
                        return null;
                    }],
                [
                    'class' => \common\widgets\ActionColumn::class,
                    'header' => 'Aksi',
                    'template' => '{view}',
                ]
            ]
        ]) ?>
    </div>
</div>
