<?php

use common\models\GaleriProduk;
use yii\bootstrap4\Carousel;
use yii\bootstrap4\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Produk */
/* @var $gambar GaleriProduk[] */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Produk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$arrayGambar = \yii\helpers\ArrayHelper::map($gambar, 'id', 'nama_berkas');
$dataGambar = array_values($arrayGambar);
$gams = [];
foreach ($dataGambar as $gamber) {
    $gams[] = Html::img(Yii::getAlias('@.produkPath/' . $gamber), ['width' => '50%', 'class' => 'rounded mx-auto d-block carousel']);
}

?>
<div class="row">
    <div class="col-lg-12">

        <!--begin::Portlet-->
        <div class="kt-portlet">

            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-lg-12">
                        <?= Carousel::widget([
                            'items' => $gams,
                            'showIndicators' => true,
                        ]) ?>
                    </div>
                </div>

            </div>
        </div>
        <!--end::Portlet-->

    </div>
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
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">


                            <?= Html::a('<i class=flaticon2-edit></i> Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-warning btn-elevate btn-elevate-air']) ?>
                            <?= Html::a('<i class=flaticon2-delete></i> Hapus', ['delete', 'id' => $model->id], [
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
                <div class="produk-view">


                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
//                            'id',
                            'nama',
                            'deskripsi:html',
                            'spesifikasi:html',
                            'fitur:html',
                            'harga:currency',
                            'demo:url',
                            ['attribute' => 'manual', 'value' => Yii::getAlias('@.produkPath/' . $model->manual), 'format' => 'url'],
                            'nego:boolean',
                            ['attribute' => 'nego0.harga_satu', 'visible' => $model->nego, 'format' => 'currency'],
                            ['attribute' => 'nego0.harga_dua', 'visible' => $model->nego, 'format' => 'currency'],
                            ['attribute' => 'nego0.harga_tiga', 'visible' => $model->nego, 'format' => 'currency'],
                            'video',
//                            'created_at:datetime',
//                            'updated_at:datetime',
                        ],
                    ]) ?>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>

<?php
$css = <<<CSS
    .carousel{
        filter: brightness(85%);
    }
CSS;
$this->registerCss($css);

?>



