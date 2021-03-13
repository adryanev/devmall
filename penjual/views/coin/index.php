<?php

/**
 * @var $this yii\web\View
 * @var $booth common\models\Booth
 * @var $coin common\models\Coin
 * @var $ledger yii\data\ActiveDataProvider
 */
$this->title = 'Saldo Coin';
?>

<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title"><?=$this->title .': '.Yii::$app->formatter->asCurrency($coin->saldo)?></h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <?=\kartik\grid\GridView::widget([
            'dataProvider' => $ledger,
            'summary' => false,
            'columns' => [
                ['class'=>\kartik\grid\SerialColumn::class,'header' => 'No'],
                ['attribute' => 'created_at','label' => 'Waktu','format' => 'datetime'],
                ['attribute' => 'type','value' => function($model){
                    return \common\models\CoinLedger::TYPE[$model->type];
                }],
                'amount:currency'
            ]
        ])?>
    </div>
</div>
