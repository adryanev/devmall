<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel penjual\models\PromoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notfikasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12">

        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon2-list-2"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= Html::encode($this->title) ?> <small>portlet sub title</small>
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="promo-index">


                    <?php Pjax::begin(); ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn', 'header' => 'No'],
                            ['attribute' => 'sender', 'value'=>'user.username'],
                            'context',
                            'status',
                            'created_at:date',
                            ['class' => 'common\widgets\ActionColumn', 'header' => 'Aksi',
                                'template' => '{view}'],
                        ],

                    ]); ?>

                    <?php Pjax::end(); ?>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>



