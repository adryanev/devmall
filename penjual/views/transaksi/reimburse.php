<?php
/**
 * @var $this yii\web\View
 * @var $reimburseDataProvider yii\data\ActiveDataProvider
 */
$this->title = 'Reimbursement';
?>
<h4>
    <?="Saldo: ".Yii::$app->formatter->asCurrency(Yii::$app->user->identity->booth->coin->saldo)?>
</h4>
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
                    <?=\yii\bootstrap4\Html::button('<i class="la la-money"></i>Reimburse',['class'=>'btn btn-primary btn-elevate btn-elevate-air showModalButton','value'=>\yii\helpers\Url::to(['coin/reimbursement']),'title'=>'Reimbursement'])?>
                </div>
            </div>

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
