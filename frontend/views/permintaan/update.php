<?php

/**
 * @var $this yii\web\View;
 * @var $model common\models\PermintaanProduk
 * @var $modelDetail frontend\models\forms\permintaan\PermintaanDetailUploadForm
 */

$this->title = 'Ubah Permintaan Produk';
$this->params['breadcrumbs'][] = ['label' => 'Booth', 'url' => ['booth/view', 'id' => $model->id_booth]];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>


<section class="dashboard-area">
    <div class="dashboard_contents">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="dashboard_title_area">
                        <div class="dashboard__title">
                            <h3><?= $this->title ?></h3>
                        </div>
                    </div>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?= $this->render(
                        '_form',
                        ['model' => $model, 'modelDetail' => $modelDetail, 'dataDetail' => $dataDetail]
                    ) ?>

                </div>
            </div>
        </div>
    </div>
</section>
