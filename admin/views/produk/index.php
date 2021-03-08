<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel admin\models\KategoriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Produk';
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
                        <?= Html::encode($this->title) ?> <small>produk</small>
                    </h3>
                </div>
               
            </div>
            <div class="kt-portlet__body">
                <div class="kategori-index">


                    <?php Pjax::begin(); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn', 'header' => 'No'],

                            ['attribute' => 'nama',
                                'filterInputOptions' => [
                                        'class'=>'form-control',
                                    'placeholder'=>'Pencarian Nama Barang'
                                ],
                                'contentOptions'=> ['style'=>'width:30%'] 
                            ],
                            ['attribute' => 'demo',

                                'filterInputOptions' => [
                                        'class'=>'form-control',
                                    'placeholder'=>'Pencarian Fitur'
                                ],
                                'contentOptions'=> ['style'=>'width:20%']
                            ],
                            ['attribute' => 'harga',

                                'filterInputOptions' => [
                                        'class'=>'form-control',
                                    'placeholder'=>'Pencarian Harga'
                                ],
                                'contentOptions'=> ['style'=>'width:15%; text-align:right']
                            ],
//                            'created_at:datetime',
//                            'updated_at:datetime',

                            ['class' => 'common\widgets\ActionLihatHapus', 'header' => 'Aksi'],
                        ],
                    ]); ?>

                    <?php Pjax::end(); ?>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>



