<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Reimbursement
 */

use yii\bootstrap4\Html;

$this->title = 'Reimbursement: '.$model->nomor_rekening;
$this->params['breadcrumbs'][]=['label'=>'Reimbursement','url'=>['reimburse/index']];
$this->params['breadcrumbs'][] = ['label'=>$this->title];
?>

<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                <?=$this->title?>
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                   <?php
                   if ($model->status === \common\models\Reimbursement::STATUS_CREATED) {
                      echo \yii\bootstrap4\Html::a('<i class="la la-paper-plane-o"></i> Terima',
                           ['reimburse/terima'], [
                               'class' => 'btn btn-dark btn-pill btn-sm btn-elevate btn-elevate-air',
                               'data' => [
                                   'method' => 'POST',
                                   'confirm' => 'Apakah anda ingin menerima permintaan ini?',
                                   'params' => ['id' => $model->id]
                               ]
                           ]);
                   }
                   if($model->status === \common\models\Reimbursement::STATUS_PROGRESS){
                       echo \yii\bootstrap4\Html::button('<i class="la la-check-circle-o"> Selesai</i>',['class'=>'btn btn-success btn-pill btn-sm btn-elevate btn-elevate-air showModalButton',
                           'value'=>\yii\helpers\Url::to(['reimburse/selesai','id'=>$model->id]),
                           'title'=>'Selesai Reimbursement',
                       ]);
                   }
                   ?>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet__body">
        <?=\yii\widgets\DetailView::widget([
            'model' => $model,
            'attributes' => [
                'created_at:datetime',
                'amount:currency',
                'bank',
                'nomor_rekening',
                'status'
            ]
        ])?>
    </div>
</div>
