<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel admin\models\KategoriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelola Admin';
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
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
            <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <?= Html::a('<i class=flaticon2-add></i> Tambah Admin', ['kelola-admin/create'], ['class' => 'btn btn-success btn-elevate btn-elevate-air']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kategori-index">

                    <?php Pjax::begin(); ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn', 'header' => 'No'],

//                            'id',
                            ['attribute' => 'username',
                                'filterInputOptions' => [
                                        'class'=>'form-control',
                                    'placeholder'=>'Pencarian Username'
                                ],
                              'contentOptions'=> ['style'=>'width:20%'] 
                            ],

                            ['attribute' => 'email',

                                'filterInputOptions' => [
                                        'class'=>'form-control',
                                    'placeholder'=>'Pencarian Alamat Email'
                                ]],
                                
                            ['attribute' => 'status',
                             'value' => function($model){
                                return $model->status == 0 ? 'Inactive':'Active';
                             },
                             'filter' => [
                                0 =>'Inactive',
                                1 => 'Active'
                             ],
                             'contentOptions'=>['style'=>'width:10%']
                            ],
                            ['class' => 'common\widgets\ActionColumn', 'header' => 'Password',
                                'template' => '{change}'],
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



