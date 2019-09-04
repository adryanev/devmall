<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\FrontendAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">SEARCH HERE</h4>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <form method="get" class="searchform" action="/search" role="search">
                        <input type="hidden" name="type" value="product">
                        <input type="text" name="q" class="form-control control-search">
                        <span class="input-group-btn">
                              <button class="btn btn-default button_search" type="button"><i data-toggle="dropdown" class="ion-ios-search"></i></button>
                            </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<header>
    <div class="topbar-mobile hidden-lg hidden-md">
        <div class="active-mobile">
            <div class="language-popup dropdown">
                <a id="label" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="icon"><i class="ion-ios-world-outline" aria-hidden="true"></i></span>
                    <span>English</span>
                    <span class="ion-chevron-down"></span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="label">
                    <li><a href="#">English</a></li>
                    <li><a href="#">Vietnamese</a></li>
                </ul>
            </div>
        </div>
        <div class="right-nav">
            <div class="active-mobile">
                <div class="header_user_info popup-over e-scale hidden-lg hidden-md dropdown">
                    <div data-toggle="dropdown" class="popup-title dropdown-toggle" title="Account">
                        <i class="ion-android-person"></i><span> Account</span>
                    </div>
                    <ul class="links dropdown-menu list-unstyled">
                        <li>
                            <a id="customer_login_link" href="#" title="Sign in"><i class="ion-log-in"></i> Login</a>
                        </li>
                        <li>
                            <a id="customer_register_link" href="#" title="Register"><i class="ion-ios-personadd"></i> Register</a>
                        </li>
                        <li>
                            <a class="account" rel="nofollow" href="#" title="My account"><i class="ion-ios-person"></i> My account</a>
                        </li>
                        <li>
                            <a id="wishlist-total" title="Wishlist" href="#"><i class="ion-ios-heart"></i> Wishlist</a>
                        </li>
                        <li>
                            <a href="#" title="Check out"><i class="ion-ios-cart"></i> Check out</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="active-mobile search-popup pull-right">
                <div class="search-popup dropdown" data-toggle="modal" data-target="#myModal">
                    <i class="ion-search fa-3a"></i>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="top-nav hidden-xs hidden-sm">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <div class="left-nav">
                        <div class="location dropdown">
                            <a id="label1" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="icon"><i class="ion-ios-location" aria-hidden="true"></i></span>
                                <span>Our Store</span>
                                <span class="ion-chevron-down"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="label1">
                                <li><a href="#">New York</a></li>
                                <li><a href="#">California</a></li>
                            </ul>
                        </div>
                        <div class="language dropdown">
                            <a id="label2" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="icon"><i class="ion-ios-world-outline" aria-hidden="true"></i></span>
                                <span>English</span>
                                <span class="ion-chevron-down"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="label2">
                                <li><a href="#">English</a></li>
                                <li><a href="#">Vietnamese</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <div class="right-nav">
                        <ul>
                            <li><a href="#"><i class="ion-ios-heart fa-1a" aria-hidden="true"></i>wishlist</a></li>
                            <li><a href="#"><i class="ion-arrow-swap fa-1a" aria-hidden="true"></i>compare</a></li>
                            <li><a href="#"><i class="ion-ios-personadd fa-1a" aria-hidden="true"></i>create account</a></li>
                            <li><a href="#"><i class="ion-log-in fa-1a" aria-hidden="true"></i>login</a></li>
                        </ul>
                        <span class="phone">800-123-6789</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-8 col-xs-7 logo">
                    <a href="#" title="Clickbuy"><img src="img/logo.png" alt="images" class="img-reponsive"></a>
                </div>
                <div class="col-md-9 col-sm-4 col-xs-5 nextlogo">
                    <div class="block block-2">
                        <div class="cart">
                            <a href="#" title="" id="label3" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <div class="photo photo-cart">
                                    <img src="img/cart.png" alt="images" class="img-reponsive">
                                    <span class="lbl">05</span>
                                </div>
                                <p class="inform inform-cart">
                                    <span class="strong">CART<br></span>
                                    <span class="price-cart">$1150.69</span>
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-cart" aria-labelledby="label3">
                                <ul>
                                    <li>
                                        <div class="item-order">
                                            <div class="item-photo">
                                                <a href="#"><img src="img/cart1.png" alt="images" class="img-responsive"></a>
                                            </div>
                                            <div class="item-content">
                                                <h3><a href="#" title="">iPad Pro MLMX2CL/A</a></h3>
                                                <p class="price black">$199.69</p>
                                                <p class="quantity">x1</p>
                                            </div>
                                        </div>
                                        <div class="btn-delete"><a href="#" title="" class="btndel">x</a></div>
                                    </li>
                                    <li>
                                        <div class="item-order">
                                            <div class="item-photo">
                                                <a href="#"><img src="img/cart1.png" alt="images" class="img-responsive"></a>
                                            </div>
                                            <div class="item-content">
                                                <h3><a href="#" title="">iPad Pro MLMX2CL/A</a></h3>
                                                <p class="price black">$199.69</p>
                                                <p class="quantity">x1</p>
                                            </div>
                                        </div>
                                        <div class="btn-delete"><a href="#" title="" class="btndel">x</a></div>
                                    </li>
                                </ul>
                                <div class="content-1">
                                    <span class="total">Total: <strong class="price black">$399.00</strong></span>
                                    <span class="quantity"><strong class="number">02</strong> products</span>
                                </div>
                                <div class="content-2">
                                    <a href="#" class="addcart">ADD TO CART</a>
                                    <a href="#" class="viewcart">View Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block block-1">
                        <div class="protect">
                            <div class="photo">
                                <svg width="28" height="33" id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 180.05 214.27">
                                    <title>security</title>
                                    <path d="M196.93,55.17c-.11-5.78-.21-11.25-.21-16.54a7.5,7.5,0,0,0-7.5-7.5c-32.07,0-56.5-9.22-76.85-29a7.5,7.5,0,0,0-10.46,0c-20.35,19.79-44.77,29-76.84,29a7.5,7.5,0,0,0-7.5,7.5c0,5.29-.1,10.76-.22,16.54-1,53.84-2.44,127.57,87.33,158.68a7.49,7.49,0,0,0,4.91,0C199.36,182.74,198,109,196.93,55.17ZM107.13,198.81c-77-28-75.82-89.23-74.79-143.35.06-3.25.12-6.4.16-9.48,30-1.27,54.06-10.37,74.63-28.28,20.57,17.91,44.59,27,74.63,28.28,0,3.08.1,6.23.16,9.48C183,109.58,184.12,170.84,107.13,198.81Z" transform="translate(-17.11 0)" />
                                    <path d="M133,81.08l-36.2,36.2L81.31,101.83a7.5,7.5,0,0,0-10.61,10.61l20.75,20.75a7.5,7.5,0,0,0,10.61,0l41.5-41.5A7.5,7.5,0,1,0,133,81.08Z" transform="translate(-17.11 0)" />
                                </svg>
                            </div>
                            <p class="inform">
                                <span class="strong">Infomation<br></span> Protected
                            </p>
                        </div>
                        <div class="return">
                            <div class="photo">
                                <svg width="30" height="30" id="Capa_2" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 612 612.85">
                                    <title>update-arrows</title>
                                    <path d="M600.48,221.79c-14.43-50.5-40.14-94.33-77.94-132.13a300.48,300.48,0,0,0-100-66.57C385,7.84,346.58,0,306.78,0V37.47c69.91,0,138.93,27,190,78.28A264.15,264.15,0,0,1,564.7,231.16c12.55,43.87,14.38,88,4.68,132.47A261.77,261.77,0,0,1,509.83,482l-52.18-51.18V558.33l130.13,2-52.18-52.18Q587.78,448.93,604.84,373A301.45,301.45,0,0,0,600.48,221.79Z" transform="translate(-0.43)" />
                                    <path d="M47.85,382A267.44,267.44,0,0,1,43.5,249.56,263.58,263.58,0,0,1,103.38,130.8l52.18,51.85V54.53L25.44,53.19l51.85,51.52Q25.11,163.92,8,239.85a301.82,301.82,0,0,0,4.35,151.54c14.34,50.2,40.14,94,77.95,131.81a300.35,300.35,0,0,0,100,66.57,306.59,306.59,0,0,0,116.42,23.08v-36.8a267,267,0,0,1-190.35-78.94C83.54,464.09,60.41,425.9,47.85,382Z" transform="translate(-0.43)" />
                                </svg>
                            </div>
                            <p class="inform">
                                <span class="strong">Free<br></span> Return
                            </p>
                        </div>
                    </div>
                    <div class="search hidden-xs hidden-sm">
                        <form action="#" class="search-form">
                            <input type="text" name="s" class="form-control" placeholder="Search entrie store here">
                            <button type="submit" class="search-icon"></button>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-6 column-left">
                    <aside id="column-left">
                        <nav class="navbar-default">
                            <div class="menu-heading js-nav-menu">ALL CATEGORIES</div>
                            <div class="vertical-wrapper js-dropdown-menu js-dropdown-open active">
                                <ul class="level0">
                                    <li><a href="#">camera</a><span class="icon icon-camera"></span></li>
                                    <li><a href="#">laptop</a><span class="icon"></span></li>
                                    <li><a href="#">mobile phone</a><span class="icon"></span></li>
                                    <li class="game">
                                        <a href="#">game control</a>
                                        <div class="dropdown-content">
                                            <ul class="level1">
                                                <li class="sub-menu col-3">
                                                    <a href="#">ACCESSORIES</a>
                                                    <ul class="level2">
                                                        <li class="col-inner"><a href="#">Maybellin Face Power</a></li>
                                                        <li class="col-inner"><a href="#">Chanel Mascara</a></li>
                                                        <li class="col-inner"><a href="#">Mascara For Full Lashes Mascara</a></li>
                                                        <li class="col-inner"><a href="#">Offical Cosme-Decom Maybellin Face</a></li>
                                                        <li class="col-inner"><a href="#">Offical Cosme-Decom</a></li>
                                                        <li class="col-inner"><a href="#">Lady Dior Mascara</a></li>
                                                        <li class="col-inner"><a href="#">Mirinda</a></li>
                                                    </ul>
                                                </li>
                                                <li class="sub-menu col-3">
                                                    <a href="#">Electronic</a>
                                                    <ul class="level2">
                                                        <li class="col-inner"><a href="#">Maybellin Face Power</a></li>
                                                        <li class="col-inner"><a href="#">Chanel Mascara</a></li>
                                                        <li class="col-inner"><a href="#">Mascara For Full Lashes Mascara</a></li>
                                                        <li class="col-inner"><a href="#">Offical Cosme-Decom Maybellin Face</a></li>
                                                        <li class="col-inner"><a href="#">Offical Cosme-Decom</a></li>
                                                        <li class="col-inner"><a href="#">Lady Dior Mascara</a></li>
                                                        <li class="col-inner"><a href="#">Casopia</a></li>
                                                    </ul>
                                                </li>
                                                <li class="sub-menu col-3">
                                                    <a href="#">COMPUTER & OTHERS</a>
                                                    <ul class="level2">
                                                        <li class="col-inner"><a href="#">Maybellin Face Power</a></li>
                                                        <li class="col-inner"><a href="#">Chanel Mascara</a></li>
                                                        <li class="col-inner"><a href="#">Mascara For Full Lashes Mascara</a></li>
                                                        <li class="col-inner"><a href="#">Offical Cosme-Decom Maybellin Face</a></li>
                                                        <li class="col-inner"><a href="#">Offical Cosme-Decom</a></li>
                                                        <li class="col-inner"><a href="#">Lady Dior Mascara</a></li>
                                                        <li class="col-inner"><a href="#">Draven</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                            <div class="banner">
                                                <a href="#"><img src="img/megamenubanner.png" alt="images" class="img-responsive"></a>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a href="#">headphone</a></li>
                                    <li><a href="#">mouse</a></li>
                                    <li><a href="#">washing machine</a></li>
                                    <li><a href="#">air conditional</a></li>
                                    <li><a href="#">accessories</a></li>
                                    <li><a href="#">others</a></li>
                                    <li class="sub-form-li">
                                        <div>
                                            Subscribe
                                        </div>
                                        <form action="#" class="sub-form">
                                            <input type="text" name="e" class="form-control" placeholder="Your email here...">
                                            <button type="submit" class="btn btn-sub">Send Now <span class="ion-chevron-right"></span></button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </aside>
                </div>
                <div class="col-md-9 col-sm-8 col-xs-6 column-right">
                    <div class="deal">
                        <a href="#" class="btn-deal">Hot Deal</a>
                    </div>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="menu-title">MENU</span>
                    </button>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="menubar js-menubar">
                            <li class=" menu-homepage menu-item-has-child dropdown">
                                <a href="#" title="Home"><i class="fa fa-home"></i>home</a>
                                <span class="plus js-plus-icon"></span>
                                <ul class="dropdown-menu menu-level">
                                    <li><a href="index.html" title="home 1">Home 1</a></li>
                                    <li><a href="home-2.html" title="home 2">Home 2</a></li>
                                    <li><a href="home-3.html" title="home 3">Home 3</a></li>
                                    <li><a href="home-4.html" title="home 4">Home 4</a></li>
                                    <li><a href="home-5.html" title="home 5">Home 5</a></li>
                                    <li><a href="home-6.html" title="home 6">Home 6</a></li>
                                </ul>
                            </li>
                            <li class="menu-collection-page menu-item-has-child dropdown">
                                <a href="#" title="Marketplace">marketplace</a>
                                <span class="plus js-plus-icon"></span>
                                <ul class="dropdown-menu menu-level">
                                    <li><a href="product-collection.html" title="shop collection">Shop Collection</a></li>
                                    <li><a href="shop-list-v2.html" title="shop list v1">Shop List V1</a></li>
                                    <li><a href="shop-list-v3.html" title="shop list v2">Shop List V2</a></li>
                                    <li><a href="#" title="shoplist v3">Shop List V3</a></li>
                                </ul>
                            </li>
                            <li class=" menu-demo-page menu-item-has-child dropdown">
                                <a href="#" title="Sellerdemo">SELLER DEMO</a>
                                <span class="plus js-plus-icon"></span>
                                <div class="dropdown-menu dropdown-menu-bg">
                                    <ul class="level1">
                                        <li class="sub-menu col-3">
                                            <a href="#">Cart pages</a>
                                            <ul class="level2">
                                                <li class="col-inner"><a href="checkout-1.html" title="">Shopping Cart</a></li>
                                                <li class="col-inner"><a href="checkout-2.html" title="">Check Out</a></li>
                                                <li class="col-inner"><a href="checkout-3.html" title="">Order</a></li>
                                            </ul>
                                        </li>
                                        <li class="sub-menu col-3">
                                            <a href="#">Product Pages</a>
                                            <ul class="level2">
                                                <li class="col-inner"><a href="shop-single.html" title="">Shop Single V1</a></li>
                                                <li class="col-inner"><a href="shop-single-v2.html" title="">Shop Single V2</a></li>
                                                <li class="col-inner"><a href="#" title="">Shop Single V3</a></li>
                                            </ul>
                                        </li>
                                        <li class="sub-menu col-3">
                                            <a href="#">NEW Arrival</a>
                                            <ul class="level2">
                                                <li class="text-center"><a href="comming-soon.html"><img src="img/megaimg.png" alt="images" class="img-responsive"></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                            </li>
                            <li class="dropdown menu-contact-page menu-item-has-child">
                                <a href="#" title="ContactUs">CONTACT US</a>
                                <span class="plus js-plus-icon"></span>
                                <ul class="dropdown-menu menu-level">
                                    <li><a href="contact_us.html" title="contact us">Contact Us </a></li>
                                    <li><a href="about-us.html" title="about us">About Us</a></li>
                                </ul>
                            </li>
                            <li class="dropdown menu-blog-page menu-item-has-child">
                                <a href="#" title="Blog">blog</a>
                                <span class="plus js-plus-icon"></span>
                                <ul class="dropdown-menu menu-level menu-level-last">
                                    <li><a href="blog-v1.html" title="blog">Blog</a></li>
                                    <li><a href="blog-single-v1.html" title="blog-single">Blog Single</a></li>
                                </ul>
                            </li>
                            <li class="dropdown menu-others-page menu-item-has-child"><a href="#" title="Others">others</a>
                                <span class="plus js-plus-icon"></span>
                                <ul class="dropdown-menu menu-level menu-level-last">
                                    <li><a href="404.html" title="error page">404</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- /header -->
<section class="slide">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="row top-row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="single-item js-banner">
                            <div class="slide-img">
                                <img src="img/slider/image-slider1.jpg" alt="images" class="img-reponsive">
                                <div class="slide-content">
                                    <h5 class="brand">Sony ALPHA</h5>
                                    <h3><span class="strong">Perfection</span><br>for all</h3>
                                    <p>Dolor sit amet, consecte, adipiscing.</p>
                                </div>
                                <a href="#" class="slide-button">shop now</a>
                            </div>
                            <div class="slide-img">
                                <img src="img/slider/image-slider2.jpg" alt="images" class="img-reponsive">
                                <div class="slide-content ver2">
                                    <h5 class="brand">Sony ALPHA</h5>
                                    <h3><span class="strong">Perfection</span><br>for all</h3>
                                    <p>Dolor sit amet, consecte, adipiscing.</p>
                                </div>
                                <a href="#" class="slide-button">shop now</a>
                            </div>
                            <div class="slide-img">
                                <img src="img/slider/image-slider3.jpg" alt="images" class="img-reponsive">
                                <div class="slide-content ver2">
                                    <h5 class="brand">Sony ALPHA</h5>
                                    <h3><span class="strong">Perfection</span><br>for all</h3>
                                    <p>Dolor sit amet, consecte, adipiscing.</p>
                                </div>
                                <a href="#" class="slide-button">shop now</a>
                            </div>
                            <div class="slide-img">
                                <img src="img/slider/image-slider4.jpg" alt="images" class="img-reponsive">
                                <div class="slide-content ver2">
                                    <h5 class="brand">Sony ALPHA</h5>
                                    <h3><span class="strong">Perfection</span><br>for all</h3>
                                    <p>Dolor sit amet, consecte, adipiscing.</p>
                                </div>
                                <a href="#" class="slide-button">shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="sub-banner">
                            <a href="#"><img src="img/banner/banner-2.jpg" alt="images" class="img-reponsive"></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="sub-banner">
                            <a href="#"><img src="img/banner/banner-3.jpg" alt="images" class="img-reponsive"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-banner"></div>
</section>
<section class="bigdeal">
    <div class="container">
        <div class="label label-1">ONSALE</div>
        <div class="sale-list">
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <div class="product-item ver4 top-inner">
                        <div class="prod-item-img">
                            <a href="#"><img src="img/products/iwatch2.jpg" alt="images" class="img-reponsive"></a>
                            <div class="prod-choose">
                                <div class="prod-color">
                                    <span class="dot"></span>
                                    <span class="dot yellow"></span>
                                    <span class="dot green"></span>
                                </div>
                                <div class="prod-price">
                                    <span class="price old">$200.50</span>
                                    <span class="price-ver2 price-lg">$125.00</span>
                                    <span class="productPriceDiscount">Save<br><span class="strong">$75.5</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="prod-info">
                            <h3><a class="prod-name" href="#" title="">Sony Smartwatch 3 - 2016</a></h3>
                            <p class="brand">SONY</p>
                            <div class="ratingstar">
                                <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                <span class="number">(12)</span>
                            </div>
                            <div class="prod-description">
                                <ul>
                                    <li>Plays all your music, fomat type (WAV, MP4, ...)</li>
                                    <li>Fills the room with immersive</li>
                                    <li>Allows hands-free</li>
                                    <li>Controls lights, switches</li>
                                </ul>
                            </div>
                            <div class="countdown" data-countdown="countdown" data-date="08-31-2018-00-00-00">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12 ">
                    <div class="product-item ver1 padding--bottom margin-r">
                        <div class="prod-item-img set--width">
                            <a class="image" href="#"><img src="img/products/ipad.jpg" alt="images" class="img-responsive"></a>
                        </div>
                        <div class="prod-info ver1">
                            <h3><a href="#" title="">iPad Pro MLMX2CL/A (MLMX2LL/A) 9.7-inch</a></h3>
                            <div class="ratingstar sm">
                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                <span class="number">(12)</span>
                            </div>
                            <div class="prod-price">
                                <span class="price old">$299.6</span>
                                <span class="price">$210.25</span>
                            </div>
                        </div>
                        <div class="label label-2 blue">New</div>
                    </div>
                    <div class="product-item ver1 margin-r ">
                        <div class="prod-item-img set--width">
                            <a class="image" href="#"><img src="img/products/seiko.jpg" alt="images" class="img-responsive"></a>
                        </div>
                        <div class="prod-info ver1">
                            <h3><a href="#" title="">Motorola Moto 360 Sport - 45mm, Black</a></h3>
                            <div class="ratingstar sm">
                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                <span class="number">(12)</span>
                            </div>
                            <div class="prod-price">
                                <span class="price old">$399.6</span>
                                <span class="price">$327.50</span>
                            </div>
                        </div>
                        <div class="label label-2 red">Hot</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="featured-product">
    <div class="container">
        <div class="heading-v1">
            <h3 class="pull-left">featured products</h3>
            <ul class="otherr-link pull-right">
                <li class="active"><a data-toggle="pill" href="#all">all</a></li>
                <li><a data-toggle="pill" href="#elec">Electronic</a></li>
                <li><a data-toggle="pill" href="#fashion">Fashion        </a></li>
                <li><a data-toggle="pill" href="#it">IT        </a></li>
                <li><a data-toggle="pill" href="#food">Food & Drink</a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="tab-content">
            <div id="all" class="tab-pane fade in active">
                <div class="prod-fea-list">
                    <div class="row">
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/smarphone.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Sony Xperia X Compact - Unlocked Smartphone...</a></h3>
                                    <div class="ratingstar sm">
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <span class="number">(12)</span>
                                    </div>
                                    <div class="prod-price">
                                        <span class="price black">$212.20</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/sound3.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Sony MDRXB950BT/B Ex .fa-1tra Bass Bluetooth Headphones...</a></h3>
                                    <div class="ratingstar sm">
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <span class="number">(12)</span>
                                    </div>
                                    <div class="p-price">
                                        <span class="price old">$699.6</span>
                                        <span class="price">$510.02</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/tivi.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Samsung UN65KS8000 65-Inch 4K Ultra HD Smart LED TV...</a></h3>
                                    <div class="ratingstar sm" style="display:none;">
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <span class="number">(12)</span>
                                    </div>
                                    <div class="p-price margin--top">
                                        <span class="price old">$399.6</span>
                                        <span class="price">$299.69</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/sony.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Sony a7 Full-Frame Mirrorless Digital Camera...</a></h3>
                                    <div class="ratingstar sm">
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <span class="number">(12)</span>
                                    </div>
                                    <div class="p-price">
                                        <span class="price black">$199.69</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/macbook.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Apple iPad 4 16GB 9.7" Retina Display WiFi Bluetooth...</a></h3>
                                    <div class="ratingstar" style="display:none;"><span class="number">(12)</span></div>
                                    <div class="p-price margin--top">
                                        <span class="price old">$299.6</span>
                                        <span class="price">$109.69</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="elec" class="tab-pane fade ">
                <div class="prod-fea-list">
                    <div class="row">
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/smarphone.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Sony Xperia X Compact - Unlocked Smartphone...</a></h3>
                                    <div class="ratingstar sm">
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <span class="number">(12)</span>
                                    </div>
                                    <div class="prod-price">
                                        <span class="price black">$212.20</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/sound3.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Sony MDRXB950BT/B Ex .fa-1tra Bass Bluetooth Headphones...</a></h3>
                                    <div class="ratingstar sm">
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <span class="number">(12)</span>
                                    </div>
                                    <div class="p-price">
                                        <span class="price old">$699.6</span>
                                        <span class="price">$510.02</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/tivi.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Samsung UN65KS8000 65-Inch 4K Ultra HD Smart LED TV...</a></h3>
                                    <div class="ratingstar sm" style="display:none;">
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <span class="number">(12)</span>
                                    </div>
                                    <div class="p-price margin--top">
                                        <span class="price old">$399.6</span>
                                        <span class="price">$299.69</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/sony.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Sony a7 Full-Frame Mirrorless Digital Camera...</a></h3>
                                    <div class="ratingstar sm">
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <span class="number">(12)</span>
                                    </div>
                                    <div class="p-price">
                                        <span class="price black">$199.69</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/macbook.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Apple iPad 4 16GB 9.7" Retina Display WiFi Bluetooth...</a></h3>
                                    <div class="ratingstar" style="display:none;"><span class="number">(12)</span></div>
                                    <div class="p-price margin--top">
                                        <span class="price old">$299.6</span>
                                        <span class="price">$109.69</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="fashion" class="tab-pane fade ">
                <div class="prod-fea-list">
                    <div class="row">
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/smarphone.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Sony Xperia X Compact - Unlocked Smartphone...</a></h3>
                                    <div class="ratingstar sm">
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <span class="number">(12)</span>
                                    </div>
                                    <div class="prod-price">
                                        <span class="price black">$212.20</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/sound3.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Sony MDRXB950BT/B Ex .fa-1tra Bass Bluetooth Headphones...</a></h3>
                                    <div class="ratingstar sm">
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <span class="number">(12)</span>
                                    </div>
                                    <div class="p-price">
                                        <span class="price old">$699.6</span>
                                        <span class="price">$510.02</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/tivi.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Samsung UN65KS8000 65-Inch 4K Ultra HD Smart LED TV...</a></h3>
                                    <div class="ratingstar sm" style="display:none;">
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <span class="number">(12)</span>
                                    </div>
                                    <div class="p-price margin--top">
                                        <span class="price old">$399.6</span>
                                        <span class="price">$299.69</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/sony.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Sony a7 Full-Frame Mirrorless Digital Camera...</a></h3>
                                    <div class="ratingstar sm">
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <span class="number">(12)</span>
                                    </div>
                                    <div class="p-price">
                                        <span class="price black">$199.69</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/macbook.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Apple iPad 4 16GB 9.7" Retina Display WiFi Bluetooth...</a></h3>
                                    <div class="ratingstar" style="display:none;"><span class="number">(12)</span></div>
                                    <div class="p-price margin--top">
                                        <span class="price old">$299.6</span>
                                        <span class="price">$109.69</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="it" class="tab-pane fade  ">
                <div class="prod-fea-list">
                    <div class="row">
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/smarphone.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Sony Xperia X Compact - Unlocked Smartphone...</a></h3>
                                    <div class="ratingstar sm">
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <span class="number">(12)</span>
                                    </div>
                                    <div class="prod-price">
                                        <span class="price black">$212.20</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/sound3.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Sony MDRXB950BT/B Ex .fa-1tra Bass Bluetooth Headphones...</a></h3>
                                    <div class="ratingstar sm">
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <span class="number">(12)</span>
                                    </div>
                                    <div class="p-price">
                                        <span class="price old">$699.6</span>
                                        <span class="price">$510.02</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/tivi.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Samsung UN65KS8000 65-Inch 4K Ultra HD Smart LED TV...</a></h3>
                                    <div class="ratingstar sm" style="display:none;">
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <span class="number">(12)</span>
                                    </div>
                                    <div class="p-price margin--top">
                                        <span class="price old">$399.6</span>
                                        <span class="price">$299.69</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/sony.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Sony a7 Full-Frame Mirrorless Digital Camera...</a></h3>
                                    <div class="ratingstar sm">
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <span class="number">(12)</span>
                                    </div>
                                    <div class="p-price">
                                        <span class="price black">$199.69</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/macbook.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Apple iPad 4 16GB 9.7" Retina Display WiFi Bluetooth...</a></h3>
                                    <div class="ratingstar" style="display:none;"><span class="number">(12)</span></div>
                                    <div class="p-price margin--top">
                                        <span class="price old">$299.6</span>
                                        <span class="price">$109.69</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="food" class="tab-pane fade  ">
                <div class="prod-fea-list">
                    <div class="row">
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/smarphone.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Sony Xperia X Compact - Unlocked Smartphone...</a></h3>
                                    <div class="ratingstar sm">
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <span class="number">(12)</span>
                                    </div>
                                    <div class="prod-price">
                                        <span class="price black">$212.20</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/sound3.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Sony MDRXB950BT/B Ex .fa-1tra Bass Bluetooth Headphones...</a></h3>
                                    <div class="ratingstar sm">
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <span class="number">(12)</span>
                                    </div>
                                    <div class="p-price">
                                        <span class="price old">$699.6</span>
                                        <span class="price">$510.02</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/tivi.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Samsung UN65KS8000 65-Inch 4K Ultra HD Smart LED TV...</a></h3>
                                    <div class="ratingstar sm" style="display:none;">
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <span class="number">(12)</span>
                                    </div>
                                    <div class="p-price margin--top">
                                        <span class="price old">$399.6</span>
                                        <span class="price">$299.69</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/sony.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Sony a7 Full-Frame Mirrorless Digital Camera...</a></h3>
                                    <div class="ratingstar sm">
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                        <span class="number">(12)</span>
                                    </div>
                                    <div class="p-price">
                                        <span class="price black">$199.69</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-15 col-sm-4 col-xs-6">
                            <div class="product-item ver2">
                                <div class="prod-item-img bd-style-2">
                                    <a href="#"><img src="img/products/macbook.jpg" alt="images" class="img-responsive"></a>
                                    <div class="button">
                                        <a href="#" class="addcart">ADD TO CART</a>
                                        <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="prod-info">
                                    <h3><a href="#">Apple iPad 4 16GB 9.7" Retina Display WiFi Bluetooth...</a></h3>
                                    <div class="ratingstar" style="display:none;"><span class="number">(12)</span></div>
                                    <div class="p-price margin--top">
                                        <span class="price old">$299.6</span>
                                        <span class="price">$109.69</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="banner_1">
    <div class="container">
        <a href="#"><img src="img/banner/ad2.jpg" alt="images" class="img-responsive"></a>
    </div>
</div>
<section class="popular-product">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-sm-7 col-xs-12">
                <div class="heading-v2">
                    <ul class="breadcrumb-ver1">
                        <li class="active"><a data-toggle="pill" href="#popular">popular</a></li>
                        <li><a data-toggle="pill" href="#top">top rated</a></li>
                        <li><a data-toggle="pill" href="#new">newest</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div id="popular" class="tab-pane fade in active">
                        <div class="pp-list">
                            <div class="row top-row">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                    <div class="product-item ver2">
                                        <div class="prod-item-img bd-style-2">
                                            <a href="#"><img src="img/products/camera.jpg" alt="images" class="img-responsive"></a>
                                            <div class="button">
                                                <a href="#" class="addcart addcart-v2">ADD TO CART</a>
                                                <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="prod-info">
                                            <h3><a href="#">Sony Alpha a5000 Mirrorless Digital Camera with 16-50mm...</a></h3>
                                            <div class="ratingstar sm">
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <span class="number">(12)</span>
                                            </div>
                                            <div class="p-price">
                                                <span class="price old">$299.6</span>
                                                <span class="price">$109.69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 no-padding-right">
                                    <div class="product-item ver2">
                                        <div class="prod-item-img bd-style-2">
                                            <a href="#"><img src="img/products/lens.jpg" alt="images" class="img-responsive"></a>
                                            <div class="button">
                                                <a href="#" class="addcart addcart-v2">ADD TO CART</a>
                                                <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="prod-info">
                                            <h3><a href="#">Sony SEL1670Z Vario-Tessar T E 16-70mm F4 ZA OSS</a></h3>
                                            <div class="ratingstar sm">
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <span class="number">(12)</span>
                                            </div>
                                            <div class="p-price">
                                                <span class="price black">$199.69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 no-padding-right">
                                    <div class="product-item ver2">
                                        <div class="prod-item-img bd-style-2">
                                            <a href="#"><img src="img/products/ear.jpg" alt="images" class="img-responsive"></a>
                                            <div class="button">
                                                <a href="#" class="addcart addcart-v2">ADD TO CART</a>
                                                <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="prod-info">
                                            <h3><a href="#">Beats EP Wired On-Ear Headphone - Rose</a></h3>
                                            <div class="ratingstar sm">
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <span class="number">(12)</span>
                                            </div>
                                            <div class="p-price">
                                                <span class="price black">$199.69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 no-padding-right">
                                    <div class="product-item ver2">
                                        <div class="prod-item-img bd-style-2">
                                            <a href="#"><img src="img/products/watch.jpg" alt="images" class="img-responsive"></a>
                                            <div class="button">
                                                <a href="#" class="addcart addcart-v2">ADD TO CART</a>
                                                <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="prod-info">
                                            <h3><a href="#">PowerLead Pwah PL-N20 Bluetooth 4.0 Smart Watch...</a></h3>
                                            <div class="ratingstar sm">
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <span class="number">(12)</span>
                                            </div>
                                            <div class="p-price">
                                                <span class="price old">$299.6</span>
                                                <span class="price">$109.69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 no-padding-right">
                                    <div class="product-item ver2">
                                        <div class="prod-item-img bd-style-2">
                                            <a href="#"><img src="img/products/canonpixma.jpg" alt="images" class="img-responsive"></a>
                                            <div class="button">
                                                <a href="#" class="addcart addcart-v2">ADD TO CART</a>
                                                <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="prod-info">
                                            <h3><a href="#">Canon PIXMA Pro-100 Wireless Color Professional Inkjet...</a></h3>
                                            <div class="ratingstar sm">
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <span class="number">(12)</span>
                                            </div>
                                            <div class="p-price">
                                                <span class="price old">$299.6</span>
                                                <span class="price">$109.69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 no-padding-right">
                                    <div class="product-item ver2">
                                        <div class="prod-item-img bd-style-2">
                                            <a href="#"><img src="img/products/sound4.jpg" alt="images" class="img-responsive"></a>
                                            <div class="button">
                                                <a href="#" class="addcart addcart-v2">ADD TO CART</a>
                                                <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="prod-info">
                                            <h3><a href="#">Sony SBH52BLACK Sony Stereo Bluetooth Headset</a></h3>
                                            <div class="ratingstar sm">
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <span class="number">(12)</span>
                                            </div>
                                            <div class="p-price">
                                                <span class="price black">$199.69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="top" class="tab-pane fade">
                        <div class="pp-list">
                            <div class="row top-row">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 no-padding-right">
                                    <div class="product-item ver2">
                                        <div class="prod-item-img bd-style-2">
                                            <a href="#"><img src="img/products/camera.jpg" alt="images" class="img-responsive"></a>
                                            <div class="button">
                                                <a href="#" class="addcart addcart-v2">ADD TO CART</a>
                                                <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="prod-info">
                                            <h3><a href="#">Sony Alpha a5000 Mirrorless Digital Camera with 16-50mm...</a></h3>
                                            <div class="ratingstar sm">
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <span class="number">(12)</span>
                                            </div>
                                            <div class="p-price">
                                                <span class="price old">$299.6</span>
                                                <span class="price">$109.69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 no-padding-right">
                                    <div class="product-item ver2">
                                        <div class="prod-item-img bd-style-2">
                                            <a href="#"><img src="img/products/lens.jpg" alt="images" class="img-responsive"></a>
                                            <div class="button">
                                                <a href="#" class="addcart addcart-v2">ADD TO CART</a>
                                                <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="prod-info">
                                            <h3><a href="#">Sony SEL1670Z Vario-Tessar T E 16-70mm F4 ZA OSS</a></h3>
                                            <div class="ratingstar sm">
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <span class="number">(12)</span>
                                            </div>
                                            <div class="p-price">
                                                <span class="price black">$199.69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 no-padding-right">
                                    <div class="product-item ver2">
                                        <div class="prod-item-img bd-style-2">
                                            <a href="#"><img src="img/products/ear.jpg" alt="images" class="img-responsive"></a>
                                            <div class="button">
                                                <a href="#" class="addcart addcart-v2">ADD TO CART</a>
                                                <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="prod-info">
                                            <h3><a href="#">Beats EP Wired On-Ear Headphone - Rose</a></h3>
                                            <div class="ratingstar sm">
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <span class="number">(12)</span>
                                            </div>
                                            <div class="p-price">
                                                <span class="price black">$199.69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 no-padding-right">
                                    <div class="product-item ver2">
                                        <div class="prod-item-img bd-style-2">
                                            <a href="#"><img src="img/products/watch.jpg" alt="images" class="img-responsive"></a>
                                            <div class="button">
                                                <a href="#" class="addcart addcart-v2">ADD TO CART</a>
                                                <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="prod-info">
                                            <h3><a href="#">PowerLead Pwah PL-N20 Bluetooth 4.0 Smart Watch...</a></h3>
                                            <div class="ratingstar sm">
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <span class="number">(12)</span>
                                            </div>
                                            <div class="p-price">
                                                <span class="price old">$299.6</span>
                                                <span class="price">$109.69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 no-padding-right">
                                    <div class="product-item ver2">
                                        <div class="prod-item-img bd-style-2">
                                            <a href="#"><img src="img/products/canonpixma.jpg" alt="images" class="img-responsive"></a>
                                            <div class="button">
                                                <a href="#" class="addcart addcart-v2">ADD TO CART</a>
                                                <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="prod-info">
                                            <h3><a href="#">Canon PIXMA Pro-100 Wireless Color Professional Inkjet...</a></h3>
                                            <div class="ratingstar sm">
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <span class="number">(12)</span>
                                            </div>
                                            <div class="p-price">
                                                <span class="price old">$299.6</span>
                                                <span class="price">$109.69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 no-padding-right">
                                    <div class="product-item ver2">
                                        <div class="prod-item-img bd-style-2">
                                            <a href="#"><img src="img/products/sound4.jpg" alt="images" class="img-responsive"></a>
                                            <div class="button">
                                                <a href="#" class="addcart addcart-v2">ADD TO CART</a>
                                                <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="prod-info">
                                            <h3><a href="#">Sony SBH52BLACK Sony Stereo Bluetooth Headset</a></h3>
                                            <div class="ratingstar sm">
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <span class="number">(12)</span>
                                            </div>
                                            <div class="p-price">
                                                <span class="price black">$199.69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="new" class="tab-pane fade">
                        <div class="pp-list">
                            <div class="row top-row">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 no-padding-right">
                                    <div class="product-item ver2">
                                        <div class="prod-item-img bd-style-2">
                                            <a href="#"><img src="img/products/camera.jpg" alt="images" class="img-responsive"></a>
                                            <div class="button">
                                                <a href="#" class="addcart addcart-v2">ADD TO CART</a>
                                                <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="prod-info">
                                            <h3><a href="#">Sony Alpha a5000 Mirrorless Digital Camera with 16-50mm...</a></h3>
                                            <div class="ratingstar sm">
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <span class="number">(12)</span>
                                            </div>
                                            <div class="p-price">
                                                <span class="price old">$299.6</span>
                                                <span class="price">$109.69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 no-padding-right">
                                    <div class="product-item ver2">
                                        <div class="prod-item-img bd-style-2">
                                            <a href="#"><img src="img/products/lens.jpg" alt="images" class="img-responsive"></a>
                                            <div class="button">
                                                <a href="#" class="addcart addcart-v2">ADD TO CART</a>
                                                <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="prod-info">
                                            <h3><a href="#">Sony SEL1670Z Vario-Tessar T E 16-70mm F4 ZA OSS</a></h3>
                                            <div class="ratingstar sm">
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <span class="number">(12)</span>
                                            </div>
                                            <div class="p-price">
                                                <span class="price black">$199.69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 no-padding-right">
                                    <div class="product-item ver2">
                                        <div class="prod-item-img bd-style-2">
                                            <a href="#"><img src="img/products/ear.jpg" alt="images" class="img-responsive"></a>
                                            <div class="button">
                                                <a href="#" class="addcart addcart-v2">ADD TO CART</a>
                                                <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="prod-info">
                                            <h3><a href="#">Beats EP Wired On-Ear Headphone - Rose</a></h3>
                                            <div class="ratingstar sm">
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <span class="number">(12)</span>
                                            </div>
                                            <div class="p-price">
                                                <span class="price black">$199.69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 no-padding-right">
                                    <div class="product-item ver2">
                                        <div class="prod-item-img bd-style-2">
                                            <a href="#"><img src="img/products/watch.jpg" alt="images" class="img-responsive"></a>
                                            <div class="button">
                                                <a href="#" class="addcart addcart-v2">ADD TO CART</a>
                                                <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="prod-info">
                                            <h3><a href="#">PowerLead Pwah PL-N20 Bluetooth 4.0 Smart Watch...</a></h3>
                                            <div class="ratingstar sm">
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <span class="number">(12)</span>
                                            </div>
                                            <div class="p-price">
                                                <span class="price old">$299.6</span>
                                                <span class="price">$109.69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 no-padding-right">
                                    <div class="product-item ver2">
                                        <div class="prod-item-img bd-style-2">
                                            <a href="#"><img src="img/products/canonpixma.jpg" alt="images" class="img-responsive"></a>
                                            <div class="button">
                                                <a href="#" class="addcart addcart-v2">ADD TO CART</a>
                                                <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="prod-info">
                                            <h3><a href="#">Canon PIXMA Pro-100 Wireless Color Professional Inkjet...</a></h3>
                                            <div class="ratingstar sm">
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <span class="number">(12)</span>
                                            </div>
                                            <div class="p-price">
                                                <span class="price old">$299.6</span>
                                                <span class="price">$109.69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 no-padding-right">
                                    <div class="product-item ver2">
                                        <div class="prod-item-img bd-style-2">
                                            <a href="#"><img src="img/products/sound4.jpg" alt="images" class="img-responsive"></a>
                                            <div class="button">
                                                <a href="#" class="addcart addcart-v2">ADD TO CART</a>
                                                <a href="#" class="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="prod-info">
                                            <h3><a href="#">Sony SBH52BLACK Sony Stereo Bluetooth Headset</a></h3>
                                            <div class="ratingstar sm">
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-star-o fa-1" aria-hidden="true"></i></a>
                                                <span class="number">(12)</span>
                                            </div>
                                            <div class="p-price">
                                                <span class="price black">$199.69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <aside class="widget brand-v1">
                    <div class="heading-v1">
                        <h3>BRAND CORNER</h3>
                    </div>
                    <div class="brand-list-v1">
                        <div class="product-item ver1 bd-style">
                            <div class="prod-item-img">
                                <a href="#"><img src="img/products/canon_pixma.jpg" alt="images" class="img-responsive"></a>
                            </div>
                            <div class="prod-info">
                                <h3><a href="#">Canon MX492 Wireless All-IN-One Small...</a></h3>
                                <div class="p-price">
                                    <span class="price black">$199.69</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-item ver1 bd-style">
                            <div class="prod-item-img">
                                <a href="#"><img src="img/products/canon.jpg" alt="images" class="img-responsive"></a>
                            </div>
                            <div class="prod-info">
                                <h3><a href="#">Canon EOS 6D Digital SLR Camera + EF...</a></h3>
                                <div class="p-price">
                                    <span class="price old">$299.6</span>
                                    <span class="price">$109.69</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-item ver1">
                            <div class="prod-item-img">
                                <a href="#"><img src="img/products/canon2.jpg" alt="images" class="img-responsive"></a>
                            </div>
                            <div class="prod-info">
                                <h3><a href="#">Canon 0111C001 PowerShot SX610 HS, Wi-Fi...</a></h3>
                                <div class="p-price">
                                    <span class="price black">$199.69</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="brand-list-v1">
                        <div class="product-item ver1 bd-style">
                            <div class="prod-item-img">
                                <a href="#"><img src="img/products/imac.jpg" alt="images" class="img-responsive"></a>
                            </div>
                            <div class="prod-info">
                                <h3><a href="#">Apple iMac MK462LL/A 27-Inch Retina 5K...</a></h3>
                                <div class="p-price">
                                    <span class="price old">$299.6</span>
                                    <span class="price">$109.69</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-item ver1 bd-style">
                            <div class="prod-item-img">
                                <a href="#"><img src="img/products/iwatch.jpg" alt="images" class="img-responsive"></a>
                            </div>
                            <div class="prod-info">
                                <h3><a href="#">Apple Watch Series 1 38mm Smartwatch...</a></h3>
                                <div class="p-price">
                                    <span class="price black">$199.69</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-item ver1">
                            <div class="prod-item-img">
                                <a href="#"><img src="img/products/macmini2.jpg" alt="images" class="img-responsive"></a>
                            </div>
                            <div class="prod-info">
                                <h3><a href="#">Apple Mac Mini MC936LL/A with Lion Server</a></h3>
                                <div class="p-price">
                                    <span class="price old">$299.6</span>
                                    <span class="price">$109.69</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
<div class="banner_2 sub-banner">
    <div class="container">
        <a href="#"><img src="img/banner-2.jpg" alt="images" class="img-responsive"></a>
    </div>
</div>
<div class="cate">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="heading-v3 dif">
                    <img src="img/smicon.png" alt="images" class="img-responsive">
                    <span>Smartphone</span>
                </div>
                <div class="product-item ver3">
                    <div class="photo">
                        <a href="#"><img src="img/iphone6.png" alt="images" class="img-responsive"></a>
                    </div>
                    <ul>
                        <li><a href="#">phones</a></li>
                        <li><a href="#">android</a></li>
                        <li><a href="#">google phones</a></li>
                        <li><a href="#">apple phones</a></li>
                        <li><a href="#">batteries</a></li>
                        <li><a href="#">charges</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="heading-v3">
                    <img src="img/laptopicon.png" alt="images" class="img-responsive">
                    <span>LAPTOP</span>
                </div>
                <div class="product-item ver3">
                    <div class="photo">
                        <a href="#"><img src="img/laptop.png" alt="images" class="img-responsive"></a>
                    </div>
                    <ul>
                        <li><a href="#">phones</a></li>
                        <li><a href="#">android</a></li>
                        <li><a href="#">google phones</a></li>
                        <li><a href="#">apple phones</a></li>
                        <li><a href="#">batteries</a></li>
                        <li><a href="#">charges</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="heading-v3">
                    <img src="img/camicon.png" alt="images" class="img-responsive">
                    <span>CAMERA</span>
                </div>
                <div class="product-item ver3">
                    <div class="photo">
                        <a href="#"><img src="img/cam.png" alt="images" class="img-responsive"></a>
                    </div>
                    <ul>
                        <li><a href="#">phones</a></li>
                        <li><a href="#">android</a></li>
                        <li><a href="#">google phones</a></li>
                        <li><a href="#">apple phones</a></li>
                        <li><a href="#">batteries</a></li>
                        <li><a href="#">charges</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="brand">
    <div class="container">
        <div class="owl-carousel owl-theme js-owl-brand">
            <div class="item">
                <a href="#"><img src="img/brand/midnight.jpg" alt="images"></a>
            </div>
            <div class="item">
                <a href="#"><img src="img/brand/shepad.jpg" alt="images"></a>
            </div>
            <div class="item">
                <a href="#"><img src="img/brand/target.jpg" alt="images"></a>
            </div>
            <div class="item">
                <a href="#"><img src="img/brand/netsuite.jpg" alt="images"></a>
            </div>
            <div class="item">
                <a href="#"><img src="img/brand/yourclothes.jpg" alt="images"></a>
            </div>
            <div class="item">
                <a href="#"><img src="img/brand/midnight.jpg" alt="images"></a>
            </div>
            <div class="item">
                <a href="#"><img src="img/brand/midnight.jpg" alt="images"></a>
            </div>
            <div class="item">
                <a href="#"><img src="img/brand/midnight.jpg" alt="images"></a>
            </div>
            <div class="item">
                <a href="#"><img src="img/brand/midnight.jpg" alt="images"></a>
            </div>
            <div class="item">
                <a href="#"><img src="img/brand/midnight.jpg" alt="images"></a>
            </div>
        </div>
    </div>
</div>
<div class="features">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12 fea-column-inner">
                <div class="fea-box">
                    <div class="photo">
                        <img src="img/gift.png" alt="images" class="img-reponsive">
                    </div>
                    <p class="inform-ver2">
                        <span class="strong">Deal of the day<br></span> check out today's deal
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 fea-column-inner">
                <div class="fea-box">
                    <div class="photo">
                        <img src="img/fly.png" alt="images" class="img-reponsive">
                    </div>
                    <p class="inform-ver2">
                        <span class="strong">Free Shipping<br></span> on thousands of products
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 fea-column-inner">
                <div class="fea-box">
                    <div class="photo">
                        <img src="img/return.png" alt="images" class="img-reponsive">
                    </div>
                    <p class="inform-ver2">
                        <span class="strong">Easy Returns<br></span> on all purchases made
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 fea-column-inner">
                <div class="fea-box">
                    <div class="photo">
                        <img src="img/secu.png" alt="images" class="img-reponsive">
                    </div>
                    <p class="inform-ver2">
                        <span class="strong">Best Services Medal<br></span> we are proud of best service
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<footer>
    <div class="info">
        <div class="container">
            <div class="row ">
                <div class="col-md-3 col-xs-12 ">
                    <div class="photo">
                        <a href="#"><img src="img/logo.png" alt="images" class="img-responsive"></a>
                    </div>
                    <p class="info-desc">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusant...</p>
                    <div class="widget-info">
                        <ul>
                            <li><i class="ion-ios-location fa-4" aria-hidden="true"></i>One World Trade Center Suite 8500 New York, NY 1006</li>
                            <li class="clearfix"></li>
                            <li><i class="ion-ios-telephone fa-4" aria-hidden="true"></i>
                                <p class="title-contain">(800) 8001-8588</p>
                            </li>
                            <li class="clearfix"></li>
                            <li><i class="ion-email-unread fa-4" aria-hidden="true"></i>
                                <p class="title-contain">ClickShop@support.com</p>
                            </li>
                            <li class="clearfix"></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5 col-xs-12">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <h3>let us help you</h3>
                            <ul class="fmenu">
                                <li><a href="#">your account</a></li>
                                <li><a href="#">your orders</a></li>
                                <li><a href="#">shipping rates & policies</a></li>
                                <li><a href="#">clickShop prime</a></li>
                                <li><a href="#">return & Replacements</a></li>
                                <li><a href="#">Manage Your Content and Devices</a></li>
                                <li><a href="#">ClickShop Assistant</a></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-xs-12 pd-left">
                            <h3>useful links</h3>
                            <ul class="fmenu">
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">About ClickShop</a></li>
                                <li><a href="#">Investor Relations</a></li>
                                <li><a href="#">Our Devices</a></li>
                                <li><a href="#">Apps & Download</a></li>
                                <li><a href="#">Thinking</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <h3>Newsletter</h3>
                    <p class="news-desc">Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</p>
                    <form action="#" class="news-letter-form">
                        <input type="text" name="e" class="form-control" placeholder="Enter your e-mail">
                        <button type="submit" class="btnsub">Subscribe</button>
                    </form>
                    <h3 class="titles">FIND US ON:</h3>
                    <ul class="social">
                        <li><a href="#"><i class="ion-social-facebook fa-3" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="ion-social-twitter fa-3" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="ion-social-googleplus fa-3" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="ion-social-youtube fa-3" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="ion-social-linkedin fa-3" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="top-footer">
        <div class="container">
            <h1 class="heading-default">Top Categories & Brands</h1>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 block-left">
                    <div class="block-footer">
                        <h2 class="heading-primary">WHAT'S NEW</h2>
                        <p class="description-primary">
                            <a title="smartphone" href="#" >Huawei P9</a>,&nbsp;
                            <a title="smartphone" href="#" >Samsung S7</a>,&nbsp;
                            <a title="smartphone" href="#" >Samsung S7 Edge</a>,&nbsp;
                            <a title="smartphone" href="#" >Electric Unicycle</a>,&nbsp;
                            <a title="smartphone" href="#" >Electric Scooter</a>,&nbsp;
                            <a title="smartphone" href="#" >Foldable Bicycle</a>,&nbsp;
                            <a title="smartphone" href="#" >OnePlus X</a>,&nbsp;
                            <a title="smartphone" href="#" >Ninebot Mini Pro</a>,&nbsp;
                            <a title="smartphone" href="#" >Samsung Note 5</a>,&nbsp;
                            <a title="smartphone" href="#" >Samsung Edge</a>,&nbsp;
                            <a title="smartphone" href="#" >Samsung S6</a>,&nbsp;
                            <a title="smartphone" href="#" >Phone 6S</a>,&nbsp;
                            <a title="smartphone" href="#" >iPhone 6</a>,&nbsp;
                            <a title="smartphone" href="#" >Oneplus-2</a>,&nbsp;
                            <a title="smartphone" href="#" >Apple Watch</a>,&nbsp;
                            <a title="smartphone" href="#" >Amazon Kindle</a>
                        </p>
                    </div>
                    <div class="block-footer">
                        <h2 class="heading-primary">MOBILES & TABLETS</h2>
                        <p class="description-primary">
                            <a title="smartphone" href="#" >Apple</a>,&nbsp;
                            <a title="smartphone" href="#" >Asus</a>,&nbsp;
                            <a title="smartphone" href="#" >HTC</a>,&nbsp;
                            <a title="smartphone" href="#" >Huawei</a>,&nbsp;
                            <a title="smartphone" href="#" >Lenovo</a>,&nbsp;
                            <a title="smartphone" href="#" >LG</a>,&nbsp;
                            <a title="smartphone" href="#" >Nokia X</a>,&nbsp;
                            <a title="smartphone" href="#" >Oppo</a>,&nbsp;
                            <a title="smartphone" href="#" >One Plus</a>,&nbsp;
                            <a title="smartphone" href="#" >Kindle</a>,&nbsp;
                            <a title="smartphone" href="#" >Samsung</a>,&nbsp;
                            <a title="smartphone" href="#" >Sony</a>,&nbsp;
                            <a title="smartphone" href="#" >Xiaomi</a>
                        </p>
                    </div>
                    <div class="block-footer no-padding-bottom">
                        <h2 class="heading-primary">COMPUTERS & LAPTOPS</h2>
                        <p class="description-primary">
                            <a title="smartphone" href="#" >Acer</a>,&nbsp;
                            <a title="smartphone" href="#" >Alienware</a>,&nbsp;
                            <a title="smartphone" href="#" >Asus</a>,&nbsp;
                            <a title="smartphone" href="#" >Corsair</a>,&nbsp;
                            <a title="smartphone" href="#" >Dell</a>,&nbsp;
                            <a title="smartphone" href="#" >Lenovo</a>,&nbsp;
                            <a title="smartphone" href="#" >Logitech </a>,&nbsp;
                            <a title="smartphone" href="#" >MSI</a>
                            <br>
                            <a title="smartphone" href="#" >Altec Lansing</a>,&nbsp;
                            <a title="smartphone" href="#" >Armaggeddon</a>,&nbsp;
                            <a title="smartphone" href="#" >Audio Technica</a>,&nbsp;
                            <a title="smartphone" href="#" >Beats</a>,&nbsp;
                            <a title="smartphone" href="#" >Belkin</a>,&nbsp;
                            <a title="smartphone" href="#" >Bose</a>,&nbsp;
                            <a title="smartphone" href="#" >Fitbit</a>,&nbsp;
                            <a title="smartphone" href="#" >Ninteno</a>
                        </p>
                    </div>
                </div>
                <div class="col-md-6 block-right">
                    <div class="block-footer">
                        <h2 class="heading-primary">CONSUMER ELECTRONIC</h2>
                        <p class="description-primary">
                            <a title="smartphone" href="#" >Altec Lansing</a>,&nbsp;
                            <a title="smartphone" href="#" >Armaggeddon</a>,&nbsp;
                            <a title="smartphone" href="#" >Audio Technica</a>,&nbsp;
                            <a title="smartphone" href="#" >Beats</a>,&nbsp;
                            <a title="smartphone" href="#" >Belkin</a>,&nbsp;
                            <a title="smartphone" href="#" >Bose</a>,&nbsp;
                            <a title="smartphone" href="#" >Fitbit</a>,&nbsp;
                            <a title="smartphone" href="#" >Nintendo</a>,&nbsp;
                            <a title="smartphone" href="#" >Panasonic</a>,&nbsp;
                            <a title="smartphone" href="#" >PS4</a>,&nbsp;
                            <a title="smartphone" href="#" >Sennheiser</a>
                        </p>
                    </div>
                    <div class="block-footer">
                        <h2 class="heading-primary">FASHION</h2>
                        <p class="description-primary">
                            <a title="smartphone" href="#" >Birkenstock</a>,&nbsp;
                            <a title="smartphone" href="#" >Coach</a>,&nbsp;
                            <a title="smartphone" href="#" >Herschel</a>,&nbsp;
                            <a title="smartphone" href="#" >Kate Spade</a>,&nbsp;
                            <a title="smartphone" href="#" >Longchamp</a>,&nbsp;
                            <a title="smartphone" href="#" >MCM</a>,&nbsp;
                            <a title="smartphone" href="#" >Rayban</a>,&nbsp;
                            <a title="smartphone" href="#" >Tory Burch</a>
                            <br>
                            <a title="smartphone" href="#" >Canon</a>,&nbsp;
                            <a title="smartphone" href="#" >Casio</a>,&nbsp;
                            <a title="smartphone" href="#" >Fujifilm</a>,&nbsp;
                            <a title="smartphone" href="#" >GoPro</a>,&nbsp;
                            <a title="smartphone" href="#" >Instax</a>,&nbsp;
                            <a title="smartphone" href="#" >Leica</a>,&nbsp;
                            <a title="smartphone" href="#" >Nikon</a>,&nbsp;
                            <a title="smartphone" href="#" >Olympus</a>,&nbsp;
                            <a title="smartphone" href="#" >Panasonic</a>
                        </p>
                    </div>
                    <div class="block-footer no-padding-bottom">
                        <h2 class="heading-primary">HEALTH & BEAUTY</h2>
                        <p class="description-primary">
                            <a title="smartphone" href="#" >Biotherm</a>,&nbsp;
                            <a title="smartphone" href="#" >Clarins</a>,&nbsp;
                            <a title="smartphone" href="#" >Dior</a>,&nbsp;
                            <a title="smartphone" href="#" >Estee Lauder</a>,&nbsp;
                            <a title="smartphone" href="#" >Etude House</a>,&nbsp;
                            <a title="smartphone" href="#" >GNC</a>,&nbsp;
                            <a title="smartphone" href="#" >Laneige</a>,&nbsp;
                            <a title="smartphone" href="#" >Lancome</a>
                            <br>
                            <a title="smartphone" href="#" >L-occitane</a>,&nbsp;
                            <a title="smartphone" href="#" >Shiseido</a>,&nbsp;
                            <a title="smartphone" href="#" >Shu Uemura</a>,&nbsp;
                            <a title="smartphone" href="#" >Skin Food</a>,&nbsp;
                            <a title="smartphone" href="#" >Herschel</a>,&nbsp;
                            <a title="smartphone" href="#" >Jansport</a>,&nbsp;
                            <a title="smartphone" href="#" >Samsonite</a>,&nbsp;
                            <a title="smartphone" href="#" >Adidas</a>,&nbsp;
                            <a title="smartphone" href="#" >Aeroline</a>,&nbsp;
                            <a title="smartphone" href="#" >AIBI</a>,&nbsp;
                            <a title="smartphone" href="#" >Aleoca</a>,&nbsp;
                            <a title="smartphone" href="#" >Billabong</a>,&nbsp;
                            <a title="smartphone" href="#" >Columbia</a>,&nbsp;
                            <a title="smartphone" href="#" >Converse</a>,&nbsp;
                            <a title="smartphone" href="#" >Garmin</a>,&nbsp;
                            <a title="smartphone" href="#" >Nike</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <span>© <a href="#" title="">ClickBuy</a> - All Rights Reserved.</span>
            <ul class="payment">
                <li><a href="#"><img src="img/paypal.png" alt="images" class="img-responsive"></a></li>
                <li><a href="#"><img src="img/visa.png" alt="images" class="img-responsive"></a></li>
                <li><a href="#"><img src="img/american.png" alt="images" class="img-responsive"></a></li>
                <li><a href="#"><img src="img/mastercard.png" alt="images" class="img-responsive"></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
