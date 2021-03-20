<?php
/**
 * @var $this yii\web\View
 * @var $reimburseDataProvider yii\data\ActiveDataProvider
 */
$this->title = 'Reimbursement';
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
            'dataProvider' => $reimburseDataProvider,
            'columns' => [
                ['class'=>\kartik\grid\SerialColumn::class],
                'created_at:datetime',
                'amount:currency',
                'status',
                ['attribute' => 'bukti','format' => ['image',['width'=>'100px','height'=>'100px']],
                    'value'=>function($model){
            if($model->bukti){
                return Yii::getAlias('@.reimbursementPath/').$model->bukti;
            }
            return null;

                    }],
            ]
        ])?>
    </div>
</div>
