<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel penjual\models\PromoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Promo';
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
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <?= Html::a('<i class=flaticon2-add></i> Tambah Promo', ['promo/create'], ['class' => 'btn btn-success btn-elevate btn-elevate-air']) ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="promo-index">


                    <?php Pjax::begin(); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn', 'header' => 'No'],

                            // 'id',
                            // 'id_booth',
                            'promo',
                            'persentase',
                            'waktu_mulai:date',
                            //'waktu_selesai',
                            //'kode_promo',
                            //'created_at',
                            //'updated_at',

                            ['class' => 'common\widgets\ActionColumn', 'header' => 'Aksi',
                            'template'=> '{view}{update}{delete}' ],
                        ],
                    ]); ?>

                    <?php Pjax::end(); ?>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>



