<?php

/* @var $this yii\web\View */
/* @var $modelPencarian SearchProductIndexForm */
/* @var $dataKategori [] */


$this->title = 'Welcome to Devmall';

use frontend\models\forms\search\SearchProductIndexForm;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

?>

<!--================================
START HERO AREA
=================================-->
<section class="hero-area bgimage">
    <div class="bg_image_holder">
        <?= Html::img('@web/images/hero_area_bg1.jpg') ?>
    </div>
    <!-- start hero-content -->
    <div class="hero-content content_above">
        <!-- start .contact_wrapper -->
        <div class="content-wrapper">
            <!-- start .container -->
            <div class="container">
                <!-- start row -->
                <div class="row">
                    <!-- start col-md-12 -->
                    <div class="col-md-12">
                        <div class="hero__content__title">
                            <h1>
                                <span class="light">Devmall</span>
                                <span class="bold">Marketplace Aplikasi Anda</span>
                            </h1>

                        </div>


                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
            </div>
            <!-- end /.container -->
        </div>
        <!-- end .contact_wrapper -->
    </div>
    <!-- end hero-content -->

    <!--start search-area -->
    <div class="search-area">
        <!-- start .container -->
        <div class="container">
            <!-- start .container -->
            <div class="row">
                <!-- start .col-sm-12 -->
                <div class="col-sm-12">
                    <!-- start .search_box -->
                    <div class="search_box">
                        <?php $form = ActiveForm::begin(['id' => 'pencarian-produk-index', 'fieldConfig' => [
                            'options' => [
                                'tag' => false,
                            ],
                        ], 'method' => 'get',
                            'action' => ['produk/search']

                        ]) ?>

                        <?= $form->field($modelPencarian, 'produk')->textInput(['class' => 'text_field', 'placeholder' => 'Cari Produk', 'name' => 'ProdukSearch[nama]'])->label(false) ?>

                        <div class="search__select select-wrap">
                            <?= $form->field($modelPencarian, 'kategori')->dropDownList($dataKategori, ['class' => 'select--field', 'name' => 'ProdukSearch[kategori]'])->label(false) ?>
                            <span class="lnr lnr-chevron-down"></span>
                        </div>
                        <?= Html::submitButton('Cari Sekarang', ['class' => 'search-btn btn-lg']) ?>
                        <?php ActiveForm::end() ?>
                    </div>
                    <!-- end ./search_box -->
                </div>
                <!-- end /.col-sm-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </div>
    <!--start /.search-area -->
</section>
<!--================================
END HERO AREA
=================================-->



<!--================================
START PRODUCTS AREA
=================================-->
<section class="products section--padding">
    <!-- start container -->
    <div class="container">
        <!-- start row -->
        <div class="row">
            <!-- start col-md-12 -->
            <div class="col-md-12">
                <div class="product-title-area">
                    <div class="product__title">
                        <h2>Newest Release Products</h2>
                    </div>

                    <div class="filter__menu">
                        <p>Filter by:</p>
                        <div class="filter__menu_icon">
                            <a href="#" id="drop1" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <img class="svg" src="images/svg/menu.svg" alt="menu icon">
                            </a>

                            <ul class="filter_dropdown dropdown-menu" aria-labelledby="drop1">
                                <li>
                                    <a href="#">Trending items</a>
                                </li>
                                <li>
                                    <a href="#">Best seller</a>
                                </li>
                                <li>
                                    <a href="#">Best rating</a>
                                </li>
                                <li>
                                    <a href="#">Low price</a>
                                </li>
                                <li>
                                    <a href="#">High price</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end /.col-md-12 -->
        </div>
        <!-- end /.row -->

        <!-- start row -->
        <div class="row">
            <!-- start .col-md-12 -->
            <div class="col-md-12">
                <div class="sorting">
                    <ul>
                        <li>
                            <a href="#">Plugins</a>
                        </li>
                        <li>
                            <a href="#">WordPress</a>
                        </li>
                        <li>
                            <a href="#">Site Template</a>
                        </li>
                        <li>
                            <a href="#">PSD Template</a>
                        </li>
                        <li>
                            <a href="#">Joomla</a>
                        </li>
                        <li>
                            <a href="#">User Interface</a>
                        </li>
                        <li>
                            <a href="#">Landing Page</a>
                        </li>
                        <li>
                            <a href="#">Software</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end /.col-md-12 -->
        </div>
        <!-- end /.row -->

        <!-- start .row -->
        <div class="row">
            <!-- start .col-md-4 -->
            <div class="col-lg-4 col-md-6">
                <!-- start .single-product -->
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <?= Html::img('@web/images/p1.jpg') ?>
                        <div class="prod_btn">
                            <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                            <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                        </div>
                        <!-- end /.prod_btn -->
                    </div>
                    <!-- end /.product__thumbnail -->

                    <div class="product-desc">
                        <a href="single-product.html" class="product_title">
                            <h4>MartPlace Extension Bundle</h4>
                        </a>
                        <ul class="titlebtm">
                            <li>
                                <?= Html::img('@web/images/auth.jpg', ['class' => 'auth-img']) ?>
                                <p>
                                    <a href="#">AazzTech</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#">
                                    <span class="lnr lnr-book"></span>Plugin</a>
                            </li>
                        </ul>

                        <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                            leo quam aliquet congue.</p>
                    </div>
                    <!-- end /.product-desc -->

                    <div class="product-purchase">
                        <div class="price_love">
                            <span>$10 - $50</span>
                            <p>
                                <span class="lnr lnr-heart"></span> 90</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart"></span>
                                <span>16</span>
                            </p>
                        </div>
                    </div>
                    <!-- end /.product-purchase -->
                </div>
                <!-- end /.single-product -->
            </div>
            <!-- end /.col-md-4 -->

            <!-- start .col-md-4 -->
            <div class="col-lg-4 col-md-6">
                <!-- start .single-product -->
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <?= Html::img('@web/images/p2.jpg') ?>
                        <div class="prod_btn">
                            <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                            <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                        </div>
                        <!-- end /.prod_btn -->
                    </div>
                    <!-- end /.product__thumbnail -->

                    <div class="product-desc">
                        <a href="single-product.html" class="product_title">
                            <h4>Mccarther Coffee Shop</h4>
                        </a>
                        <ul class="titlebtm">
                            <li>
                                <?= Html::img('@web/images/auth2.jpg', ['class' => 'auth-img']) ?>
                                <p>
                                    <a href="#">AazzTech</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#">
                                    <span class="lnr lnr-book"></span>Plugin</a>
                            </li>
                        </ul>

                        <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                            leo quam aliquet congue.</p>
                    </div>
                    <!-- end /.product-desc -->

                    <div class="product-purchase">
                        <div class="price_love">
                            <span>$10</span>
                            <p>
                                <span class="lnr lnr-heart"></span> 48</p>
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
            <div class="col-lg-4 col-md-6">
                <!-- start .single-product -->
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <?= Html::img('@web/images/p3.jpg') ?>
                        <div class="prod_btn">
                            <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                            <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                        </div>
                        <!-- end /.prod_btn -->
                    </div>
                    <!-- end /.product__thumbnail -->

                    <div class="product-desc">
                        <a href="single-product.html" class="product_title">
                            <h4>Visibility Manager Subscriptions</h4>
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
                                    <span class="lnr lnr-book"></span>Plugin</a>
                            </li>
                        </ul>

                        <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                            leo quam aliquet congue.</p>
                    </div>
                    <!-- end /.product-desc -->

                    <div class="product-purchase">
                        <div class="price_love">
                            <span>Free</span>
                            <p>
                                <span class="lnr lnr-heart"></span> 24</p>
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
                                    <span class="fa fa-star"></span>
                                </li>
                            </ul>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart"></span>
                                <span>27</span>
                            </p>
                        </div>
                    </div>
                    <!-- end /.product-purchase -->
                </div>
                <!-- end /.single-product -->
            </div>
            <!-- end /.col-md-4 -->

            <!-- start .col-md-4 -->
            <div class="col-lg-4 col-md-6">
                <!-- start .single-product -->
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <?= Html::img('@web/images/p4.jpg') ?>
                        <div class="prod_btn">
                            <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                            <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                        </div>
                        <!-- end /.prod_btn -->
                    </div>
                    <!-- end /.product__thumbnail -->

                    <div class="product-desc">
                        <a href="single-product.html" class="product_title">
                            <h4>Ajax Live Search</h4>
                        </a>
                        <ul class="titlebtm">
                            <li>
                                <?= Html::img('@web/images/auth.jpg', ['class' => 'auth-img']) ?>
                                <p>
                                    <a href="#">AazzTech</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#">
                                    <span class="lnr lnr-book"></span>Plugin</a>
                            </li>
                        </ul>

                        <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                            leo quam aliquet congue.</p>
                    </div>
                    <!-- end /.product-desc -->

                    <div class="product-purchase">
                        <div class="price_love">
                            <span>$10 - $50</span>
                            <p>
                                <span class="lnr lnr-heart"></span> 90</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart"></span>
                                <span>16</span>
                            </p>
                        </div>
                    </div>
                    <!-- end /.product-purchase -->
                </div>
                <!-- end /.single-product -->
            </div>
            <!-- end /.col-md-4 -->

            <!-- start .col-md-4 -->
            <div class="col-lg-4 col-md-6">
                <!-- start .single-product -->
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <?= Html::img('@web/images/p5.jpg') ?>
                        <div class="prod_btn">
                            <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                            <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                        </div>
                        <!-- end /.prod_btn -->
                    </div>
                    <!-- end /.product__thumbnail -->

                    <div class="product-desc">
                        <a href="single-product.html" class="product_title">
                            <h4>Mccarther Coffee Shop</h4>
                        </a>
                        <ul class="titlebtm">
                            <li>
                                <?= Html::img('@web/images/auth2.jpg', ['class' => 'auth-img']) ?>
                                <p>
                                    <a href="#">AazzTech</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#">
                                    <span class="lnr lnr-book"></span>Plugin</a>
                            </li>
                        </ul>

                        <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                            leo quam aliquet congue.</p>
                    </div>
                    <!-- end /.product-desc -->

                    <div class="product-purchase">
                        <div class="price_love">
                            <span>$10</span>
                            <p>
                                <span class="lnr lnr-heart"></span> 48</p>
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
            <div class="col-lg-4 col-md-6">
                <!-- start .single-product -->
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <?= Html::img('@web/images/p6.jpg') ?>
                        <div class="prod_btn">
                            <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                            <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                        </div>
                        <!-- end /.prod_btn -->
                    </div>
                    <!-- end /.product__thumbnail -->

                    <div class="product-desc">
                        <a href="single-product.html" class="product_title">
                            <h4>Visibility Manager Subscriptions</h4>
                        </a>
                        <ul class="titlebtm">
                            <li>
                                <?= Html::img('@web/images/auth3.jpg', ['class' => 'auth-img']) ?>
                                <p>
                                    <a href="#">AazzTech</a>
                                </p>
                            </li>
                            <li class="product_cat">
                                <a href="#">
                                    <span class="lnr lnr-book"></span>WordPress</a>
                            </li>
                        </ul>

                        <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                            leo quam aliquet congue.</p>
                    </div>
                    <!-- end /.product-desc -->

                    <div class="product-purchase">
                        <div class="price_love">
                            <span>Free</span>
                            <p>
                                <span class="lnr lnr-heart"></span> 24</p>
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
                                <span>27</span>
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

        <!-- start .row -->
        <div class="row">
            <div class="col-md-12">
                <div class="more-product">
                    <a href="all-products.html" class="btn btn--lg btn--round">All New Products</a>
                </div>
            </div>
            <!-- end ./col-md-12 -->
        </div>
        <!-- end /.row -->
    </div>
    <!-- end /.container -->
</section>
<!--================================
END PRODUCTS AREA
=================================-->


<!--================================
START FOLLOWERS FEED AREA
=================================-->
<section class="followers-feed section--padding">
    <!-- start .container -->
    <div class="container">
        <!-- start row -->
        <div class="row">
            <!-- start col-md-12 -->
            <div class="col-md-12">
                <div class="product-title-area">
                    <div class="product__title">
                        <h2>Your Followers Feed</h2>
                    </div>

                    <div class="product__slider-nav follow_feed_nav rounded">
                        <span class="lnr lnr-chevron-left nav_left"></span>
                        <span class="lnr lnr-chevron-right nav_right"></span>
                    </div>
                </div>
            </div>
            <!-- end /.col-md-12 -->
        </div>
        <!-- end /.row -->

        <!-- start /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="product_slider">
                    <!-- start .single-product -->
                    <div class="product product--card">

                        <div class="product__thumbnail">
                            <?= Html::img('@web/images/p4.jpg') ?>
                            <div class="prod_btn">
                                <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                            </div>
                            <!-- end /.prod_btn -->
                        </div>
                        <!-- end /.product__thumbnail -->

                        <div class="product-desc">
                            <a href="#" class="product_title">
                                <h4>Ajax Live Search</h4>
                            </a>
                            <ul class="titlebtm">
                                <li>
                                    <?= Html::img('@web/images/auth.jpg', ['class' => 'auth-img']) ?>
                                    <p>
                                        <a href="#">AazzTech</a>
                                    </p>
                                </li>
                                <li class="product_cat">
                                    <a href="#">
                                        <span class="lnr lnr-book"></span>Plugin</a>
                                </li>
                            </ul>

                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the
                                mattis,
                                leo quam aliquet congue.</p>
                        </div>
                        <!-- end /.product-desc -->

                        <div class="product-purchase">
                            <div class="price_love">
                                <span>$10 - $50</span>
                                <p>
                                    <span class="lnr lnr-heart"></span> 90</p>
                            </div>
                            <div class="sell">
                                <p>
                                    <span class="lnr lnr-cart"></span>
                                    <span>16</span>
                                </p>
                            </div>
                        </div>
                        <!-- end /.product-purchase -->
                    </div>
                    <!-- end /.single-product -->

                    <!-- start .single-product -->
                    <div class="product product--card">

                        <div class="product__thumbnail">
                            <?= Html::img('@web/images/p2.jpg') ?>
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
                                    <?= Html::img('@web/images/auth2.jpg', ['class' => 'auth-img']) ?>
                                    <p>
                                        <a href="#">AazzTech</a>
                                    </p>
                                </li>
                                <li class="product_cat">
                                    <a href="#">
                                        <span class="lnr lnr-book"></span>Plugin</a>
                                </li>
                            </ul>

                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the
                                mattis,
                                leo quam aliquet congue.</p>
                        </div>
                        <!-- end /.product-desc -->

                        <div class="product-purchase">
                            <div class="price_love">
                                <span>$10</span>
                                <p>
                                    <span class="lnr lnr-heart"></span> 48</p>
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

                    <!-- start .single-product -->
                    <div class="product product--card">

                        <div class="product__thumbnail">
                            <?= Html::img('@web/images/p6.jpg') ?>
                            <div class="prod_btn">
                                <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                            </div>
                            <!-- end /.prod_btn -->
                        </div>
                        <!-- end /.product__thumbnail -->

                        <div class="product-desc">
                            <a href="#" class="product_title">
                                <h4>Visibility Manager Subscriptions</h4>
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
                                        <span class="lnr lnr-book"></span>WordPress</a>
                                </li>
                            </ul>

                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the
                                mattis,
                                leo quam aliquet congue.</p>
                        </div>
                        <!-- end /.product-desc -->

                        <div class="product-purchase">
                            <div class="price_love">
                                <span>Free</span>
                                <p>
                                    <span class="lnr lnr-heart"></span> 24</p>
                            </div>
                            <div class="sell">
                                <p>
                                    <span class="lnr lnr-cart"></span>
                                    <span>27</span>
                                </p>
                            </div>
                        </div>
                        <!-- end /.product-purchase -->
                    </div>
                    <!-- end /.single-product -->

                    <!-- start .single-product -->
                    <div class="product product--card">

                        <div class="product__thumbnail">
                            <?= Html::img('@web/images/p4.jpg') ?>
                            <div class="prod_btn">
                                <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                            </div>
                            <!-- end /.prod_btn -->
                        </div>
                        <!-- end /.product__thumbnail -->

                        <div class="product-desc">
                            <a href="#" class="product_title">
                                <h4>Ajax Live Search</h4>
                            </a>
                            <ul class="titlebtm">
                                <li>
                                    <?= Html::img('@web/images/auth.jpg', ['class' => 'auth-img']) ?>
                                    <p>
                                        <a href="#">AazzTech</a>
                                    </p>
                                </li>
                                <li class="product_cat">
                                    <a href="#">
                                        <span class="lnr lnr-book"></span>Plugin</a>
                                </li>
                            </ul>

                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the
                                mattis,
                                leo quam aliquet congue.</p>
                        </div>
                        <!-- end /.product-desc -->

                        <div class="product-purchase">
                            <div class="price_love">
                                <span>$10 - $50</span>
                                <p>
                                    <span class="lnr lnr-heart"></span> 90</p>
                            </div>
                            <div class="sell">
                                <p>
                                    <span class="lnr lnr-cart"></span>
                                    <span>16</span>
                                </p>
                            </div>
                        </div>
                        <!-- end /.product-purchase -->
                    </div>
                    <!-- end /.single-product -->

                    <!-- start .single-product -->
                    <div class="product product--card">

                        <div class="product__thumbnail">
                            <?= Html::img('@web/images/p2.jpg') ?>
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
                                    <?= Html::img('@web/images/auth2.jpg', ['class' => 'auth-img']) ?>
                                    <p>
                                        <a href="#">AazzTech</a>
                                    </p>
                                </li>
                                <li class="product_cat">
                                    <a href="#">
                                        <span class="lnr lnr-book"></span>Plugin</a>
                                </li>
                            </ul>

                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the
                                mattis,
                                leo quam aliquet congue.</p>
                        </div>
                        <!-- end /.product-desc -->

                        <div class="product-purchase">
                            <div class="price_love">
                                <span>$10</span>
                                <p>
                                    <span class="lnr lnr-heart"></span> 48</p>
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

                    <!-- start .single-product -->
                    <div class="product product--card">

                        <div class="product__thumbnail">
                            <?= Html::img('@web/images/p6.jpg') ?>
                            <div class="prod_btn">
                                <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                            </div>
                            <!-- end /.prod_btn -->
                        </div>
                        <!-- end /.product__thumbnail -->

                        <div class="product-desc">
                            <a href="#" class="product_title">
                                <h4>Visibility Manager Subscriptions</h4>
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
                                        <span class="lnr lnr-book"></span>WordPress</a>
                                </li>
                            </ul>

                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the
                                mattis,
                                leo quam aliquet congue.</p>
                        </div>
                        <!-- end /.product-desc -->

                        <div class="product-purchase">
                            <div class="price_love">
                                <span>Free</span>
                                <p>
                                    <span class="lnr lnr-heart"></span> 24</p>
                            </div>
                            <div class="sell">
                                <p>
                                    <span class="lnr lnr-cart"></span>
                                    <span>27</span>
                                </p>
                            </div>
                        </div>
                        <!-- end /.product-purchase -->
                    </div>
                    <!-- end /.single-product -->
                </div>
            </div>
        </div>
        <!-- end /.row -->
    </div>
    <!-- start /.container -->
</section>
<!--================================
END FOLLOWERS FEED AREA
=================================-->
<!--================================
START SELL BUY
=================================-->
<section class="proposal-area">

    <!-- start container-fluid -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 no-padding">
                <div class="proposal proposal--left bgimage">
                    <div class="bg_image_holder">
                        <?= Html::img('@web/images/bbg.png') ?>
                    </div>
                    <div class="content_above">
                        <div class="proposal__icon ">
                            <?= Html::img('@web/images/buy.png') ?>
                        </div>
                        <div class="proposal__content ">
                            <h1 class="text--white">Sell Your Products</h1>
                            <p class="text--white">Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut
                                scelerisque the mattis,
                                leo quam aliquet diamcongue is laoreet elit metus.</p>
                        </div>
                        <a href="#" class="btn--round btn btn--lg btn--white">Become an Author</a>
                    </div>
                </div>
                <!-- end /.proposal -->
            </div>

            <div class="col-md-6 no-padding">
                <div class="proposal proposal--right">
                    <div class="bg_image_holder">
                        <?= Html::img('@web/images/sbg.png') ?>
                    </div>
                    <div class="content_above">
                        <div class="proposal__icon">
                            <?= Html::img('@web/images/sell.png') ?>
                        </div>
                        <div class="proposal__content ">
                            <h1 class="text--white">Start Shopping Today</h1>
                            <p class="text--white">Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut
                                scelerisque the mattis,
                                leo quam aliquet diamcongue is laoreet elit metus.</p>
                        </div>
                        <a href="#" class="btn--round btn btn--lg btn--white">Start Shopping</a>
                    </div>
                </div>
                <!-- end /.proposal -->
            </div>
        </div>
    </div>
    <!-- start container-fluid -->
</section>
<!--================================
END SELL BUY
=================================-->
