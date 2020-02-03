<?php

/* @var $this yii\web\View */
/* @var $model common\models\PermintaanProduk */

use common\widgets\ActionColumn;
use kartik\grid\GridView;
use kartik\grid\SerialColumn;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\widgets\DetailView;

$this->title = 'Permintaan: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label'=>'Permintaan','url'=>['/permintaan/index']];
$this->params['breadcrumbs'][] = ['label'=>$this->title];

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
                <div class="permintaan-view">

                    <div class="row">
                        <div class="col-lg-12">
 <?= DetailView::widget([
                        'model'=>$model,
                        'attributes'=>[
                            'nama',
                            [
                                'attribute'=>'user.profilUser.namaLengkap',
                                'label'=>'Nama Peminta',
                                'value'=>function ($model) {
                                    return Html::a($model->user->profilUser->namaLengkap, ['user/view','id'=>$model->user->id], $options =['target'=>'_blank']);
                                },
                                'format'=>'raw'

                            ],
                            'user.nomor_hp',
                            'kriteria:html',
                            'harga:currency',
                            'uang_muka:currency',
                            'deadline:date',
                            'statusString'
                        ]
                    ])?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <br>

                    <div class="row">
                        <div class="col-lg-12">
                            <?=GridView::widget([
                                'dataProvider'=> new ActiveDataProvider(['query'=>$model->getPermintaanProdukDetails()]),
                                'summary'=>false,
                                'columns'=>[
                                    ['class'=>SerialColumn::class,'header'=>'No'],
                                    'nama_berkas',
                                    ['class'=>ActionColumn::class,'header'=>'Aksi',
                                    'template'=>'{download}',
                                    'buttons'=>[
                                        'download'=> function ($url, $model, $key) {
                                            return Html::a('<i class="la la-download"></i> Download', $url, $options = [
                                                'class'=>'btn btn-success btn-sm btn-pill btn-elevate btn-elevate-air','_target'=>'blank'
                                            ]);
                                        }
                                    ]
                                    ]
                                ]
                            ])?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
