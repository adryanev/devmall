<?php

/* @var $this yii\web\View */
/* @var $model common\models\Booth */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Booths', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

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
                                        <a href="#" class="btn btn--sm btn--round btn-danger"><i
                                                    class="fas fa-user-plus"> </i>Diikuti</a>

                                    <?php endif; ?>
                                <?php endif; ?>
                                <a href="#" class="btn btn--sm btn--round"><i class="fas fa-user-plus"></i> Ikuti</a>
                                <a href="#" class="btn btn--sm btn--round btn-success"><i class="fab fa-whatsapp"></i>
                                    Chat</a>
                            </div>
                            <!-- end /.author-btn -->
                        </div>
                        <!-- end /.author-infos -->


                    </div>
                    <!-- end /.author-card -->

                    <div class="sidebar-card author-menu">
                        <ul>
                            <li>
                                <a href="#" class="active">Profile</a>
                            </li>
                            <li>
                                <a href="author-items.html">Author Items</a>
                            </li>
                            <li>
                                <a href="author-reviews.html">Customer Reviews</a>
                            </li>
                            <li>
                                <a href="author-followers.html">Followers (67)</a>
                            </li>
                        </ul>
                    </div>
                    <!-- end /.author-menu -->

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
                            <h3>36,957</h3>
                        </div>
                    </div>
                    <!-- end /.col-md-4 -->

                    <div class="col-md-4 col-sm-4">
                        <div class="author-info scolorbg">
                            <p>Total Rating</p>
                            <div class="rating product--rating">
                                <?= StarRating::widget([
                                    'name' => 'total_ulasan_booth',
                                    'value' => $model->avgUlasan,
                                    'pluginOptions' => [
                                        'displayOnly' => true,
                                        'showCaption' => false,
                                        'theme' => 'krajee-svg',
                                        'size' => 'xs',
                                        'filledStar' => '<span class="krajee-icon krajee-icon-star"></span>',
                                        'emptyStar' => '<span class="krajee-icon krajee-icon-star"></span>']]) ?>
                                <span class="rating__count">(<?= $model->totalUlasan ?>)</span>
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="product-title-area">
                            <div class="product__title">
                                <h2>Newest Products</h2>
                            </div>

                            <a href="#" class="btn btn--sm">See all Items</a>
                        </div>
                        <!-- end /.product-title-area -->
                    </div>
                    <!-- end /.col-md-12 -->

                    <!-- start .col-md-4 -->
                    <div class="col-lg-6 col-md-6">
                        <!-- start .single-product -->
                        <div class="product product--card">

                            <div class="product__thumbnail">
                                <img src="images/p4.jpg" alt="Product Image">
                                <div class="prod_btn">
                                    <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                    <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                                </div>
                                <!-- end /.prod_btn -->
                            </div>
                            <!-- end /.product__thumbnail -->

                            <div class="product-desc">
                                <a href="#" class="product_title">
                                    <h4>Yannan Na nakka muka</h4>
                                </a>
                                <ul class="titlebtm">
                                    <li>
                                        <img class="auth-img" src="images/auth3.jpg" alt="author image">
                                        <p>
                                            <a href="#">AazzTech</a>
                                        </p>
                                    </li>
                                    <li class="product_cat">
                                        <a href="#">
                                            <img src="images/cathtm.png" alt="category image">Plugin</a>
                                    </li>
                                </ul>

                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the
                                    mattis, leo quam aliquet congue.</p>
                            </div>
                            <!-- end /.product-desc -->

                            <div class="product-purchase">
                                <div class="price_love">
                                    <span>$10</span>
                                    <p>
                                        <span class="lnr lnr-heart"></span> 48</p>
                                </div>

                                <div class="rating product--rating">
                                    <ul>
                                        <li>
                                            <span class="fa fa-star"></span>
                                        </li>
                                        <li>
                                            <span class="fa fa-star"></span>
                                        </li>
                                        <li>
                                            <span class="fa fa-star"></span>
                                        </li>
                                        <li>
                                            <span class="fa fa-star"></span>
                                        </li>
                                        <li>
                                            <span class="fa fa-star-half-o"></span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="sell">
                                    <p>
                                        <span class="lnr lnr-cart"></span>
                                        <span>50</span>
                                    </p>
                                </div>
                            </div>
                            <!-- end /.product-purchase -->
                        </div>
                        <!-- end /.single-product -->
                    </div>
                    <!-- end /.col-md-4 -->

                    <!-- start .col-md-4 -->
                    <div class="col-lg-6 col-md-6">
                        <!-- start .single-product -->
                        <div class="product product--card">

                            <div class="product__thumbnail">
                                <img src="images/p2.jpg" alt="Product Image">
                                <div class="prod_btn">
                                    <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                    <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                                </div>
                                <!-- end /.prod_btn -->
                            </div>
                            <!-- end /.product__thumbnail -->

                            <div class="product-desc">
                                <a href="#" class="product_title">
                                    <h4>Mccarther Coffee Shop</h4>
                                </a>
                                <ul class="titlebtm">
                                    <li>
                                        <img class="auth-img" src="images/auth2.jpg" alt="author image">
                                        <p>
                                            <a href="#">AazzTech</a>
                                        </p>
                                    </li>
                                    <li class="product_cat">
                                        <a href="#">
                                            <img src="images/catword.png" alt="category image">wordpress</a>
                                    </li>
                                </ul>

                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the
                                    mattis, leo quam aliquet congue.</p>
                            </div>
                            <!-- end /.product-desc -->

                            <div class="product-purchase">
                                <div class="price_love">
                                    <span>$10</span>
                                    <p>
                                        <span class="lnr lnr-heart"></span> 48</p>
                                </div>

                                <div class="rating product--rating">
                                    <ul>
                                        <li>
                                            <span class="fa fa-star"></span>
                                        </li>
                                        <li>
                                            <span class="fa fa-star"></span>
                                        </li>
                                        <li>
                                            <span class="fa fa-star"></span>
                                        </li>
                                        <li>
                                            <span class="fa fa-star"></span>
                                        </li>
                                        <li>
                                            <span class="fa fa-star-half-o"></span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="sell">
                                    <p>
                                        <span class="lnr lnr-cart"></span>
                                        <span>50</span>
                                    </p>
                                </div>
                            </div>
                            <!-- end /.product-purchase -->
                        </div>
                        <!-- end /.single-product -->
                    </div>
                    <!-- end /.col-md-4 -->

                    <!-- start .col-md-4 -->
                    <div class="col-lg-6 col-md-6">
                        <!-- start .single-product -->
                        <div class="product product--card">

                            <div class="product__thumbnail">
                                <img src="images/p2.jpg" alt="Product Image">
                                <div class="prod_btn">
                                    <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                    <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                                </div>
                                <!-- end /.prod_btn -->
                            </div>
                            <!-- end /.product__thumbnail -->

                            <div class="product-desc">
                                <a href="#" class="product_title">
                                    <h4>Mccarther Coffee Shop</h4>
                                </a>
                                <ul class="titlebtm">
                                    <li>
                                        <img class="auth-img" src="images/auth2.jpg" alt="author image">
                                        <p>
                                            <a href="#">AazzTech</a>
                                        </p>
                                    </li>
                                    <li class="product_cat">
                                        <a href="#">
                                            <img src="images/catword.png" alt="category image">wordpress</a>
                                    </li>
                                </ul>

                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the
                                    mattis, leo quam aliquet congue.</p>
                            </div>
                            <!-- end /.product-desc -->

                            <div class="product-purchase">
                                <div class="price_love">
                                    <span>$10</span>
                                    <p>
                                        <span class="lnr lnr-heart"></span> 48</p>
                                </div>

                                <div class="rating product--rating">
                                    <ul>
                                        <li>
                                            <span class="fa fa-star"></span>
                                        </li>
                                        <li>
                                            <span class="fa fa-star"></span>
                                        </li>
                                        <li>
                                            <span class="fa fa-star"></span>
                                        </li>
                                        <li>
                                            <span class="fa fa-star"></span>
                                        </li>
                                        <li>
                                            <span class="fa fa-star-half-o"></span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="sell">
                                    <p>
                                        <span class="lnr lnr-cart"></span>
                                        <span>50</span>
                                    </p>
                                </div>
                            </div>
                            <!-- end /.product-purchase -->
                        </div>
                        <!-- end /.single-product -->
                    </div>
                    <!-- end /.col-md-4 -->

                    <!-- start .col-md-4 -->
                    <div class="col-lg-6 col-md-6">
                        <!-- start .single-product -->
                        <div class="product product--card">

                            <div class="product__thumbnail">
                                <img src="images/p6.jpg" alt="Product Image">
                                <div class="prod_btn">
                                    <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                    <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                                </div>
                                <!-- end /.prod_btn -->
                            </div>
                            <!-- end /.product__thumbnail -->

                            <div class="product-desc">
                                <a href="#" class="product_title">
                                    <h4>The of the century</h4>
                                </a>
                                <ul class="titlebtm">
                                    <li>
                                        <img class="auth-img" src="images/auth.jpg" alt="author image">
                                        <p>
                                            <a href="#">AazzTech</a>
                                        </p>
                                    </li>
                                    <li class="product_cat">
                                        <a href="#">
                                            <img src="images/catph.png" alt="Category Image">PSD</a>
                                    </li>
                                </ul>

                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the
                                    mattis, leo quam aliquet congue.</p>
                            </div>
                            <!-- end /.product-desc -->

                            <div class="product-purchase">
                                <div class="price_love">
                                    <span>$10</span>
                                    <p>
                                        <span class="lnr lnr-heart"></span> 48</p>
                                </div>

                                <div class="rating product--rating">
                                    <ul>
                                        <li>
                                            <span class="fa fa-star"></span>
                                        </li>
                                        <li>
                                            <span class="fa fa-star"></span>
                                        </li>
                                        <li>
                                            <span class="fa fa-star"></span>
                                        </li>
                                        <li>
                                            <span class="fa fa-star"></span>
                                        </li>
                                        <li>
                                            <span class="fa fa-star-half-o"></span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="sell">
                                    <p>
                                        <span class="lnr lnr-cart"></span>
                                        <span>50</span>
                                    </p>
                                </div>
                            </div>
                            <!-- end /.product-purchase -->
                        </div>
                        <!-- end /.single-product -->
                    </div>
                    <!-- end /.col-md-4 -->
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
