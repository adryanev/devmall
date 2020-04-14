<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var $this yii\web\View */
/** @var $model common\models\User */

$this->title = $model->profilUser->namaLengkap;
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

                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="diskon-view">

                    <div class="row">
                        <div class="col-lg-4">
                            <?=Html::img(Yii::getAlias('@.profilUserPath/' . $model->profilUser->avatar), ['width'=>'80%','heigth'=>120,'class'=>'rounded mx-auto d-block img-fluid'])?>
                        </div>
                        <div class="col-lg-8"> <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                        'username',
                        ['attribute'=>'profilUser.namaLengkap',
                        'label'=>'Nama Lengkap'],
                        ['attribute'=>'profilUser.alamatLengkap',
                        'label'=>'Alamat Lengkap'],
                        'nomor_hp',
                        'email',
                        ['attribute'=>'profilUser.pekerjaan',
                        'label'=>'Pekerjaan'],
                        ['attribute'=>'profilUser.tanggal_lahir',
                        'label'=>'Tanggal Lahir'],
                        ['attribute'=>'profilUser.jenisKelaminString','label'=>'Jenis Kelamin']
                        ],
                    ]) ?></div>
                    </div>


                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>
