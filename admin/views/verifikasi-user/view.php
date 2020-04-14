<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\VerifikasiUser */

$this->title = $model->user->username;
$this->params['breadcrumbs'][] = ['label' => 'Verifikasi User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
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
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">


                            <?= Html::a('<i class=flaticon2-checkmark></i> Terima', ['terima', 'id' => $model->id], ['class' => 'btn btn-success btn-elevate btn-elevate-air', 'data' => [
                                'confirm' => 'Apakah anda setuju dengan verifikasi ini?',
                                'method' => 'post',
                            ],]) ?>
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
            </div>
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-view">


                            <?= DetailView::widget([
                                'model' => $model->user,
                                'attributes' => [
                                    'id',
                                    'profilUser.namaLengkap',
                                    ['attribute' => 'Avatar',
                                        'format' => ['image', ['width' => '80%']],
                                        'value'=>Yii::getAlias('@.frontend/images/profil/'.$model->user->profilUser->avatar)
                                    ],

//                                    'status',
//                                    'created_at',
//                                    'updated_at',
                                ],
                            ]) ?>

                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="verifikasi-user-view">


                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [
//                                    'id',
//                                    'id_user',
                                    ['attribute' => 'nama_file',
                                        'format' => 'image',
                                        'value' =>
                                            Yii::getAlias('@.frontend/upload/verifikasi/' . $model->nama_file)
                                    ],
                                    'jenis_verifikasi',
                                    'statusVerifikasi',
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



