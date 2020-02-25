<?php

/* @var $this yii\web\View */

/* @var $model common\models\PermintaanProduk */

/* @var $keteranganForm penjual\models\forms\KeteranganPermintaanForm */

use common\models\PermintaanProduk;
use common\widgets\ActionColumn;
use kartik\grid\GridView;
use kartik\grid\SerialColumn;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
use yii\data\ActiveDataProvider;
use yii\widgets\DetailView;

$this->title = 'Permintaan: '.$model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Permintaan', 'url' => ['/permintaan/index']];
$this->params['breadcrumbs'][] = ['label' => $this->title];

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
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <?php if ($model->status === PermintaanProduk::STATUS_DIKIRIM) : ?>
                                <?php Modal::begin([
                                    'title' => '<h4>Konfirmasi Aksi</h4>',
                                    'id' => 'modal-terima',
                                    'toggleButton' => [
                                        'label' => '<i class="flaticon2-check-mark"></i> Terima',
                                        'class' => 'btn btn-success btn-round btn-elevate btn-elevate-air'
                                    ]
                                ]) ?>
                                <?php $form = ActiveForm::begin([
                                    'id' => 'permintaan-terima-form',
                                    'action' => ['permintaan/terima']
                                ]) ?>
                                <?= Html::hiddenInput('id', $model->id) ?>
                                <?= $form->field($keteranganForm, 'keterangan') ?>
                                <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
                                <?php ActiveForm::end() ?>
                                <?php Modal::end() ?>

                                <?php Modal::begin([
                                    'title' => '<h4>Konfirmasi Aksi</h4>',
                                    'id' => 'modal-tolak',
                                    'toggleButton' => [
                                        'label' => '<i class="flaticon2-cross"></i> Tolak',
                                        'class' => 'btn btn-google btn-round btn-elevate btn-elevate-air'
                                    ]
                                ]) ?>
                                <?php $form = ActiveForm::begin([
                                    'id' => 'permintaan-tolak-form',
                                    'action' => ['permintaan/tolak']
                                ]) ?>
                                <?= Html::hiddenInput('id', $model->id) ?>

                                <?= $form->field($keteranganForm, 'keterangan') ?>
                                <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
                                <?php ActiveForm::end() ?>
                                <?php Modal::end() ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kt-portlet__body">
                <div class="permintaan-view">

                    <div class="row">
                        <div class="col-lg-12">
                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'nama',
                                    [
                                        'attribute' => 'user.profilUser.namaLengkap',
                                        'label' => 'Nama Peminta',
                                        'value' => function ($model) {
                                            return Html::a($model->user->profilUser->namaLengkap,
                                                ['user/view', 'id' => $model->user->id],
                                                $options = ['target' => '_blank']);
                                        },
                                        'format' => 'raw'

                                    ],
                                    'user.nomor_hp',
                                    'kriteria:html',
                                    'harga:currency',
                                    'uang_muka:currency',
                                    'deadline:date',
                                    'statusString'
                                ]
                            ]) ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <br>

                    <div class="row">
                        <div class="col-lg-12">
                            <?= GridView::widget([
                                'dataProvider' => new ActiveDataProvider(['query' => $model->getPermintaanProdukDetails()]),
                                'summary' => false,
                                'columns' => [
                                    ['class' => SerialColumn::class, 'header' => 'No'],
                                    'nama_berkas',
                                    [
                                        'class' => ActionColumn::class,
                                        'header' => 'Aksi',
                                        'template' => '{download}',
                                        'buttons' => [
                                            'download' => function ($url, $model, $key) {
                                                return Html::a('<i class="la la-download"></i> Download', $url,
                                                    $options = [
                                                        'class' => 'btn btn-success btn-sm btn-pill btn-elevate btn-elevate-air',
                                                        '_target' => 'blank'
                                                    ]);
                                            }
                                        ]
                                    ]
                                ]
                            ]) ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
