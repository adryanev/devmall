<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 11/4/2019
 * Time: 7:29 PM
 */

use common\models\Produk;
use yii\bootstrap4\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $model Produk
 */
?>


<!--============================================
       START MORE PRODUCT ARE
   ==============================================-->
<section class="more_product_area section--padding">
    <div class="container">
        <div class="row">
            <!-- start col-md-12 -->
            <div class="col-md-12">
                <div class="section-title">
                    <h1>Lainnya dari
                        <span class="highlighted"> <?= $model->booth->nama ?></span>
                    </h1>
                </div>
            </div>
            <!-- end /.col-md-12 -->

            <?php $lainnya = $model->booth->getProduks()->orderBy(new \yii\db\Expression('RAND()'))->limit(3)->all();
            foreach ($lainnya as $produkLainnya):
                ?>
                <!-- start .col-md-4 -->
                <div class="col-lg-4 col-md-6">
                    <!-- start .single-product -->
                    <div class="product product--card">

                        <div class="product__thumbnail">
                            <?= Html::img('@.penjual/upload/produk/' . $produkLainnya->galeriProduks[0]->nama_berkas, ['alt' => 'gambar produk', 'height' => 250]) ?>
                            <div class="prod_btn">
                                <?= Html::a('Lihat Detail', ['produk/view', 'id' => $produkLainnya->id], ['class' => 'transparent btn--sm btn--round']) ?>
                                <?= Html::a('Demo Langsung', $produkLainnya->demo, ['class' => 'transparent btn--sm btn--round']) ?>
                            </div>
                            <!-- end /.prod_btn -->
                        </div>
                        <!-- end /.product__thumbnail -->

                        <div class="product-desc">
                            <a href="#" class="product_title">
                                <h4><?= $produkLainnya->nama ?></h4>
                            </a>
                            <ul class="titlebtm">
                                <li>
                                    <?= Html::img('@.penjual/upload/verifikasi/' . $produkLainnya->booth->avatar, ['class' => 'auth-img']) ?>
                                    <p>
                                        <?= Html::a($produkLainnya->booth->nama, ['booth/view', 'id' => $produkLainnya->booth->id]) ?>
                                    </p>
                                </li>
                                <li class="product_cat">
                                    <?php foreach ($produkLainnya->kategoriProduk as $kategoriProduk): ?>

                                        <i class="lnr lnr-book"></i><a href="#">
                                            <?= $kategoriProduk->nama ?></a>
                                    <?php endforeach; ?>
                                </li>
                            </ul>

                            <?= \yii\helpers\StringHelper::truncateWords($produkLainnya->deskripsi, 50, '...', true) ?>
                        </div>
                        <!-- end /.product-desc -->

                        <div class="product-purchase">
                            <div class="price_love">
                                <span><?= Yii::$app->formatter->asCurrency($produkLainnya->harga) ?></span>
                                <p>
                                    <span class="lnr lnr-heart"></span> 48</p>
                            </div>
                            <div class="sell">
                                <p>
                                    <span class="lnr lnr-cart"></span>
                                    <span>50</span>
                                </p>
                            </div>

                            <div class="rating product--rating">
                                <?= \kartik\rating\StarRating::widget([
                                    'name' => 'rating_produk_' . $produkLainnya->id,
                                    'value' => $produkLainnya->nilaiUlasan,
                                    'pluginOptions' => [
                                        'size' => 'xs',
                                        'displayOnly' => true,
                                        'theme' => 'krajee-svg',
                                        'filledStar' => '<span class="krajee-icon krajee-icon-star"></span>',
                                        'emptyStar' => '<span class="krajee-icon krajee-icon-star"></span>'
                                    ]
                                ]) ?>
                            </div>


                        </div>
                        <!-- end /.product-purchase -->
                    </div>
                    <!-- end /.single-product -->
                </div>
                <!-- end /.col-md-4 -->

            <?php endforeach; ?>
            <!-- start .col-md-4 -->

        </div>
        <!-- end /.container -->
    </div>
    <!-- end /.container -->
</section>
<!--============================================
    END MORE PRODUCT AREA
==============================================-->
