<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 10/09/19
 * Time: 21.00
 */

use frontend\models\forms\search\SearchProductForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal; ?>


<!--================================
     START MENU AREA
 =================================-->
<!-- start menu-area -->
<div class="menu-area">
    <!-- start .top-menu-area -->
    <div class="top-menu-area">
        <!-- start .container -->
        <div class="container">
            <!-- start .row -->
            <div class="row">
                <!-- start .col-md-3 -->
                <div class="col-lg-3 col-md-3 col-6 v_middle">
                    <div class="logo">
                        <?=Html::a(Html::img('@web/images/logo-devmall.png', ['class' => 'img-fluid']),['site/index'])?>
                    </div>
                </div>
                <!-- end /.col-md-3 -->

                <!-- start .col-md-5 -->
                <div class="col-lg-8 offset-lg-1 col-md-9 col-6 v_middle">
                    <!-- start .author-area -->
                    <div class="author-area">
                        <?php if (Yii::$app->user->isGuest): ?>
                            <?= Html::a('<i class="fa fa-sign-in"></i> Log in',['site/login'],['class'=>'author-area__seller-btn inline'])?>
                        <?php else: ?>
<?php if(Yii::$app->user->identity->status === \common\models\User::STATUS_VERIFIED):?>
                        <?=Html::a('Menjadi Booth',Yii::$app->urlManagerPenjual->createUrl(['site/signup']),['class'=>'author-area__seller-btn inline '])?>

<?php endif; ?>


                        <?php endif; ?>
                        <div class="author__notification_area">
                            <ul>

                                <li class="has_dropdown">
                                    <?php if (!Yii::$app->user->isGuest): ?>

                                        <div class="icon_wrap">
                                            <span class="lnr lnr-alarm"></span>
                                            <span class="notification_count noti">25</span>
                                        </div>

                                        <div class="dropdowns notification--dropdown">

                                            <div class="dropdown_module_header">
                                                <h4>My Notifications</h4>
                                                <a href="notification.html">View All</a>
                                            </div>

                                            <div class="notifications_module">
                                                <div class="notification">
                                                    <div class="notification__info">
                                                        <div class="info_avatar">
                                                            <?= Html::img('@web/images/notification_head.png') ?>
                                                        </div>
                                                        <div class="info">
                                                            <p>
                                                                <span>Anderson</span> added to Favourite
                                                                <a href="#">Mccarther Coffee Shop</a>
                                                            </p>
                                                            <p class="time">Just now</p>
                                                        </div>
                                                    </div>
                                                    <!-- end /.notifications -->

                                                    <div class="notification__icons ">
                                                        <span class="lnr lnr-heart loved noti_icon"></span>
                                                    </div>
                                                    <!-- end /.notifications -->
                                                </div>
                                            </div>
                                            <!-- end /.dropdown -->
                                        </div>
                                    <?php endif; ?>

                                </li>
                                <li class="has_dropdown">
                                    <?php if (!Yii::$app->user->isGuest): ?>

                                    <div class="icon_wrap">
                                        <span class="lnr lnr-envelope"></span>
                                        <span class="notification_count msg">6</span>
                                    </div>

                                    <div class="dropdowns messaging--dropdown">
                                        <div class="dropdown_module_header">
                                            <h4>My Messages</h4>
                                            <a href="message.html">View All</a>
                                        </div>

                                        <div class="messages">
                                            <a href="message.html" class="message recent">
                                                <div class="message__actions_avatar">
                                                    <div class="avatar">
                                                        <img src="images/notification_head4.png" alt="">
                                                    </div>
                                                </div>
                                                <!-- end /.actions -->

                                                <div class="message_data">
                                                    <div class="name_time">
                                                        <div class="name">
                                                            <p>NukeThemes</p>
                                                            <span class="lnr lnr-envelope"></span>
                                                        </div>

                                                        <span class="time">Just now</span>
                                                        <p>Hello John Smith! Nunc placerat mi ...</p>
                                                    </div>
                                                </div>
                                                <!-- end /.message_data -->
                                            </a>
                                            <!-- end /.message -->
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                </li>

                                <li class="has_dropdown">
                                    <?php if (!Yii::$app->user->isGuest): ?>

                                    <div class="icon_wrap">
                                        <span class="lnr lnr-cart"></span>
                                        <span class="notification_count purch">2</span>
                                    </div>

                                    <div class="dropdowns dropdown--cart">
                                        <div class="cart_area">
                                            <div class="cart_product">
                                                <div class="product__info">
                                                    <div class="thumbn">
                                                        <?=Html::img('@web/images/capro2.jpg')?>
                                                    </div>

                                                    <div class="info">
                                                        <a class="title" href="single-product.html">Flounce - Multipurpose OpenCart Theme</a>
                                                        <div class="cat">
                                                            <a href="#">
                                                                <?=Html::img('@web/images/catword.png')?>Wordpress</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="product__action">
                                                    <a href="#">
                                                        <span class="lnr lnr-trash"></span>
                                                    </a>
                                                    <p>$60</p>
                                                </div>
                                            </div>
                                            <div class="total">
                                                <p>
                                                    <span>Total :</span>$80</p>
                                            </div>
                                            <div class="cart_action">
                                                <a class="go_cart" href="cart.html">View Cart</a>
                                                <a class="go_checkout" href="checkout.html">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                </li>

                            </ul>
                        </div>
                        <!--start .author__notification_area -->

                        <!--start .author-author__info-->
                        <div class="author-author__info inline has_dropdown">
                            <?php if (!Yii::$app->user->isGuest): ?>

                                <div class="author__avatar">

                                    <?= Html::img('@web/images/usr_avatar.png') ?>
                                </div>
                                <div class="autor__info">
                                    <p class="name">
                                        <?=Html::encode(Yii::$app->user->identity->profilUser->nama_depan)?>
                                    </p>

                                </div>

                                <div class="dropdowns dropdown--author">
                                    <ul>
                                        <li>
                                            <a href="<?=\yii\helpers\Url::to(['settings/account'])?>">
                                                <span class="lnr lnr-cog"></span> Setting</a>
                                        </li>
                                        <li>
                                            <a href="cart.html">
                                                <span class="lnr lnr-cart"></span>Purchases</a>
                                        </li>
                                        <li>
                                            <a href="favourites.html">
                                                <span class="lnr lnr-heart"></span> Favourite</a>
                                        </li>
                                        <li>
                                            <?= Html::a('<span class="lnr lnr-exit"></span>Logout</a>',['site/logout'],['data'=>[
                                                    'confirm'=>'Apakah anda ingin keluar?',
                                                    'method'=>'POST',
                                            ]]) ?>

                                        </li>
                                    </ul>
                                </div>
                            <?php endif; ?>

                        </div>
                        <!--end /.author-author__info-->
                    </div>
                    <!-- end .author-area -->

                    <!-- author area restructured for mobile -->
                    <div class="mobile_content ">
                        <span class="lnr lnr-user menu_icon"></span>

                        <!-- offcanvas menu -->
                        <div class="offcanvas-menu closed">
                            <span class="lnr lnr-cross close_menu"></span>
                            <?php if (!Yii::$app->user->isGuest): ?>
                                <div class="author-author__info">
                                    <div class="author__avatar v_middle">
                                        <?= Html::img('@web/images/usr_avatar.png') ?>
                                    </div>
                                    <div class="autor__info v_middle">
                                        <p class="name">
                                            Jhon Doe
                                        </p>
                                        <p class="ammount">$20.45</p>
                                    </div>
                                </div>
                                <!--end /.author-author__info-->

                                <div class="author__notification_area">
                                    <ul>
                                        <li>
                                            <a href="notification.html">
                                                <div class="icon_wrap">
                                                    <span class="lnr lnr-alarm"></span>
                                                    <span class="notification_count noti">25</span>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="message.html">
                                                <div class="icon_wrap">
                                                    <span class="lnr lnr-envelope"></span>
                                                    <span class="notification_count msg">6</span>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="cart.html">
                                                <div class="icon_wrap">
                                                    <span class="lnr lnr-cart"></span>
                                                    <span class="notification_count purch">2</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!--start .author__notification_area -->

                                <div class="dropdowns dropdown--author">
                                    <ul>

                                        <li>
                                            <a href="dashboard.html">
                                                <span class="lnr lnr-home"></span> Dashboard</a>
                                        </li>
                                        <li>
                                            <a href="dashboard-setting.html">
                                                <span class="lnr lnr-cog"></span> Setting</a>
                                        </li>
                                        <li>
                                            <a href="cart.html">
                                                <span class="lnr lnr-cart"></span>Purchases</a>
                                        </li>
                                        <li>
                                            <a href="favourites.html">
                                                <span class="lnr lnr-heart"></span> Favourite</a>
                                        </li>
                                        <li>
                                            <a href="dashboard-add-credit.html">
                                                <span class="lnr lnr-dice"></span>Add Credits</a>
                                        </li>
                                        <li>
                                            <a href="dashboard-statement.html">
                                                <span class="lnr lnr-chart-bars"></span>Sale Statement</a>
                                        </li>
                                        <li>
                                            <a href="dashboard-upload.html">
                                                <span class="lnr lnr-upload"></span>Upload Item</a>
                                        </li>
                                        <li>
                                            <a href="dashboard-manage-item.html">
                                                <span class="lnr lnr-book"></span>Manage Item</a>
                                        </li>
                                        <li>
                                            <a href="dashboard-withdrawal.html">
                                                <span class="lnr lnr-briefcase"></span>Withdrawals</a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="lnr lnr-exit"></span>Logout</a>
                                        </li>
                                    </ul>
                                </div>

                            <?php endif; ?>

                            <div class="text-center">
                                <?php if (Yii::$app->user->isGuest): ?>
                                    <a href="signup.html" class="author-area__seller-btn inline">Become a Seller</a>
                                    <a href="signup.html" class="author-area__seller-btn inline">Become a Seller</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- end /.mobile_content -->
                </div>
                <!-- end /.col-md-5 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </div>
    <!-- end  -->

    <!-- start .mainmenu_area -->
    <?= /** @var SearchProductForm $searchModel */
    $this->render('menu',['searchModel'=>$searchModel]) ?>
    <!-- end /.mainmenu-->
</div>
<!-- end /.menu-area -->
<!--================================
    END MENU AREA
=================================-->