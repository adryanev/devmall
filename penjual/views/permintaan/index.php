<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel penjual\models\PermintaanSearch */

$this->title = 'Permintaan Produk';
$this->params['breadcrumbs'][] = ['label' => $this->title];

use kartik\grid\GridView;
use yii\bootstrap4\Html;
use yii\grid\SerialColumn;

?>

<div class="row">
    <div class="col-lg-12">

        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon2-list-3"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="permintaan-index">

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => SerialColumn::class, 'header' => 'No'],
                            [
                                'attribute' => 'user',
                                'value' => 'user.username'
                            ],
                            'nama',
                            'harga:currency',
                            'uang_muka:currency',
                            [
                                'attribute' => 'deadline',
                                'format' => 'date',

                                'filterType' => GridView::FILTER_DATE,
                                'filterWidgetOptions' => [
                                    'pluginOptions' => [
                                        'format' => 'yyyy/mm/dd',
                                        'autoclose' => true,
                                        'todayHighlight' => true,
                                    ]
                                ],

                            ],
                            'created_at:date',
                            'statusString',
                            [
                                'class' => 'common\widgets\ActionColumn',
                                'header' => 'Aksi',
                                'template' => '{view}'
                            ]
                        ]
                    ]) ?>

                </div>
            </div>
        </div>

    </div>
</div>
