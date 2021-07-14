<?php

/* @var $this yii\web\View */
/* @var $model common\models\Booth */
/* @var $produkPopulerDataProvider yii\data\ActiveDataProvider */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Booths', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$colsCount = 2;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;
use kartik\rating\StarRating;
use yii\bootstrap4\Html;

?>
<!--================================
        START AUTHOR AREA
    =================================-->
<section class="author-profile-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <aside class="sidebar sidebar_author">
                    <div class="author-card sidebar-card">
                        <div class="author-infos">
                            <div class="author_avatar">
                                <?= Html::img('@.penjual/upload/verifikasi/' . $model->avatar) ?>
                            </div>

                            <div class="author">
                                <h4><?= $model->nama ?></h4>
                                <p>Bergabung sejak: <?= Yii::$app->formatter->asDate($model->created_at) ?></p>
                            </div>
                            <!-- end /.author -->


                            <div class="author-btn">
                                <?php if (!Yii::$app->user->isGuest) : ?>
                                    <?php if (Yii::$app->user->identity->following($model->id)) : ?>

                                        <?= Html::a('<i class="fas fa-user-minus"></i> Mengikuti', ['booth/unfollow', 'id' => $model->id], ['class' => 'btn btn--sm btn--round btn-info', 'data-method' => 'POST',

                                        ]) ?>

                                    <?php endif; ?>
                                <?php else: ?>
                                    <?= Html::a('<i class="fas fa-user-plus"></i> Ikuti', ['booth/follow', 'id' => $model->id], ['class' => 'btn btn--sm btn--round btn--bordered', 'data-method' => 'POST',

                                    ]) ?>
                                <?php endif; ?>

                                <?= Html::a('<i class="fab fa-whatsapp"></i> Chat', 'https://api.whatsapp.com/send?phone=' . $model->nomor_telepon, ['class' => 'btn btn--round btn--sm btn--icon btn-success', 'target' => '_blank']) ?>
                            </div>
                            <!-- end /.author-btn -->
                        </div>
                        <!-- end /.author-infos -->


                    </div>
                    <!-- end /.author-card -->

                    <div class="sidebar-card author-menu">
                        <ul>
                            <li>
                                <a href="#" class="active">Profil</a>
                            </li>
                            <li>
                                <?= Html::a('Produk', ['booth/produk', 'ProdukSearch[id_booth]' => $model->id]); ?>
                            </li>
                            <li>
                                <?= Html::a('Ulasan Pembeli', ['booth/review', 'booth' => $model->id]) ?>
                            </li>
                        </ul>
                    </div>
                    <!-- end /.author-menu -->

                    <div class="sidebar-card author-menu">
                        <ul>
                            <li>
                                <?= Html::a('Request Produk', ['permintaan/tambah', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
                            </li>
                        </ul>
                    </div>

                </aside>
            </div>
            <!-- end /.sidebar -->

            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="author-info mcolorbg4">
                            <p>Total Produk</p>
                            <h3><?= $model->getProduks()->count() ?></h3>
                        </div>
                    </div>
                    <!-- end /.col-md-4 -->

                    <div class="col-md-4 col-sm-4">
                        <div class="author-info pcolorbg">
                            <p>Total Penjualan</p>
                            <h3><?= $totalPenjualan ?></h3>
                        </div>
                    </div>
                    <!-- end /.col-md-4 -->

                    <div class="col-md-4 col-sm-4">
                        <div class="author-info scolorbg">
                            <p>Total Rating</p>
                            <div class="rating product--rating">
                                <?= StarRating::widget([
                                    'name' => 'total_ulasan_booth',
                                    'value' => $getTotalUlasan,
                                    'pluginOptions' => [
                                        'displayOnly' => true,
                                        'showCaption' => false,
                                        'theme' => 'krajee-svg',
                                        'size' => 'xs',
                                        'filledStar' => '<span class="krajee-icon krajee-icon-star"></span>',
                                        'emptyStar' => '<span class="krajee-icon krajee-icon-star"></span>']]) ?>
                                <span class="rating__count">(<?= $getTotalUlasan ?>)</span>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-4 -->

                    <div class="col-md-12 col-sm-12">
                        <div class="author_module">
                            <?php if ($model->banner): ?>
                                <?= Html::img('@.penjual/upload/verifikasi/' . $model->banner) ?>
                            <?php endif; ?>
                        </div>

                        <div class="author_module about_author">
                            <h2>Tentang
                                <span><?= $model->nama ?></span>
                            </h2>
                            <?= $model->deskripsi ?>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="product-title-area">
                                    <div class="product__title">
                                        <h2>Produk Populer</h2>
                                    </div>
                                    <?= Html::a('Lihat produk lainnya', ['booth/produk', 'ProdukSearch[id_booth]' => $model->id], ['class' => 'btn btn--sm']); ?>
                                </div>
                                <!-- end /.product-title-area -->
                            </div>
                            <!-- end /.col-md-12 -->
                            <?= \yii\widgets\ListView::widget(
                                [
                                    'dataProvider' => $produkPopulerDataProvider,
                                    'itemView' => '/produk/_search_item',
                                    'itemOptions' => [
                                        'class' => 'col-lg-6 col-md-8'

                                    ],
                                    'summary' => false,
                                    'beforeItem' => function ($model, $key, $index, $widget) use ($colsCount) {
                                        if ($index % $colsCount === 0) {
                                            return "<div class='row'>";
                                        }
                                        return '';
                                    },
                                    'afterItem' => function ($model, $key, $index, $widget) use ($colsCount) {
                                        $content = '';
                                        if (($index > 0) && ($index % $colsCount === $colsCount - 1)) {
                                            $content .= "</div>";
                                        }
                                        return $content;
                                    },
                                ]);
                            if ($produkPopulerDataProvider->count % $colsCount !== 0) {
                                echo "</div>";
                            } ?>

                        </div>

                        <br>
                        <div class="clearfix"></div>

                        <div class="author_module about_author">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h2>Alamat</h2>
                                    <?= $model->alamatLengkap ?>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php
                                    $coord = new LatLng(['lat' => $model->latitude, 'lng' => $model->longitude]);
                                    $map = new Map([
                                        'center' => $coord,
                                        'zoom' => 15
                                    ]);
                                    $map->width = '100%';
                                    $marker = new Marker(['position' => $coord,
                                        'title' => $model->nama]);

                                    $map->addOverlay($marker);
                                    echo $map->display(); ?>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- end /.row -->


            </div>
            <!-- end /.col-md-8 -->

        </div>
        <!-- end /.row -->
    </div>
    <!-- end /.container -->
</section>
<!--================================
    END AUTHOR AREA
=================================-->
