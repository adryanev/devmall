<?php
/* @var $this yii\web\View */
/* @var $dataProvider ActiveDataProvider */
$this->title = "Verifikasi";
$this->params['breadcrumbs'][] = $this->title;

use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\widgets\Pjax;

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
                        <?= Html::encode($this->title) ?> <small>Booth</small>
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kategori-index">


                    <?php Pjax::begin(); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn', 'header' => 'No'],

//                            'id',
                            'nama',
                            'deskripsi:html',
                            'kota',
                            'email',
                            'Status',
                            'created_at:datetime',
//                            'updated_at:datetime',

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

