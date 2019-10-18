<?php

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Booth */


$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Booth', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-6">
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <?= Html::img('@.penjual/upload/verifikasi/' . $model->avatar) ?>

            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <?php
                $location = new LatLng(
                    ['lat' => $model->latitude, 'lng' => $model->longitude]
                );
                $map = new Map([
                    'width' => "100%",
                    'height' => 256,
                    'center' => $location,
                    'zoom' => 15,
                ]);
                $marker = new Marker([
                    'position' => $location,
                    'title' => $model->nama
                ]);
                $map->addOverlay($marker);
                echo $map->display();
                ?>

            </div>
        </div>
    </div>

    <!--end::Portlet-->


</div>
<div class="row">
    <div class="col-lg-12">

        <!--begin::Portlet-->
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
                <?php if (!$model->isVerified()): ?>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">


                                <?= Html::a('<i class=flaticon2-checkmark></i> Terima', ['terima', 'id' => $model->id], ['class' => 'btn btn-success btn-elevate btn-elevate-air']) ?>
                                <?= Html::a('<i class=flaticon2-delete></i> Tolak', ['tolak', 'id' => $model->id], [
                                    'class' => 'btn btn-danger btn-elevate btn-elevate-air',
                                    'data' => [
                                        'confirm' => 'Apakah anda ingin menghapus item ini?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="kategori-view">


                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'id',
                                    'nama',
                                    'deskripsi:html',
                                    'email:email',
                                    'nomor_telepon',
                                    'alamat1',
                                    'alamat2',
                                    'kelurahan',
                                    'kecamatan',
                                    'kota',
                                    'provinsi',
                                    'latitude',
                                    'longitude',
                                    'created_at:datetime',
                                    'updated_at:datetime',
                                ],
                            ]) ?>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>


