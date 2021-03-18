<?php
/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
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
                    'template' => '{view}{terima}{selesai}',
                    'buttons' => [
                        'terima' => function ($url, $model) {
                            if ($model->status === \common\models\Reimbursement::STATUS_CREATED) {
                                return \yii\bootstrap4\Html::a('<i class="la la-paper-plane-o"></i> Terima',
                                    ['reimburse/terima'], [
                                        'class' => 'btn btn-dark btn-pill btn-sm btn-elevate btn-elevate-air',
                                        'data' => [
                                            'method' => 'POST',
                                            'confirm' => 'Apakah anda ingin menerima permintaan ini?',
                                            'params' => ['id' => $model->id]
                                        ]
                                    ]);
                            }
                            return null;
                        },
                        'selesai' => function ($url, $model) {
                            if($model->status === \common\models\Reimbursement::STATUS_PROGRESS){
                                return \yii\bootstrap4\Html::a('<i class="la la-check-circle-o"> Selesai</i>',['reimburse/selesai'],['class'=>'btn btn-success btn-pill btn-sm btn-elevate btn-elevate-air','data'=>[
                                    'method'=>'POST',
                                    'confirm'=>'Apakah anda ingin menyelesaikan permintaan ini?',
                                    'params'=>['id'=>$model->id]
                                ]]);
                            }
                            return null;
                        }
                    ]
                ]
            ]
        ]) ?>
    </div>
</div>
