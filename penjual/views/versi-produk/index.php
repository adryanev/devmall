<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel penjual\models\VersiProdukSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Versi Produk';
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

                            <?= Html::button('<i class=flaticon2-add></i> Tambah Versi Produk', ['value' => Url::to(['create']), 'title' => 'Tambah Versi Produk', 'class' => 'showModalButton btn btn-success btn-elevate btn-elevate-air']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="versi-produk-index">




                                                                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    
                                            <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
        'columns' => [
                        ['class' => 'yii\grid\SerialColumn','header'=>'No'],

                                    'id',
            'id_produk',
            'link_lama',
            'link_baru',
            'catatan_perubahan:ntext',
            //'cara_instalasi:ntext',
            //'created_at',
            //'updated_at',

                        ['class' => 'common\widgets\ActionColumn','header'=>'Aksi'],
                        ],
                        ]); ?>
                    
                    
                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>



