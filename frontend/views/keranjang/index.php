<?php

use common\models\Produk;
use yii\bootstrap4\Html;
use yii\helpers\StringHelper;

/**
 * @var $this yii\web\View;
 * @var $keranjangDataProvider yii\data\ActiveDataProvider;
 * @var $keranjangCount int
 * @var $keranjangTotal int
 */

$this->title = 'Keranjang Belanjaan';
$this->params['breadcrumbs'][] = $this->title;





?>

<!--================================
         START DASHBOARD AREA
 =================================-->
<section class="cart_area section--padding2 bgcolor">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product_archive added_to__cart">
                    <div class="title_area">
                        <div class="row">
                            <div class="col-md-5">
                                <h4>Produk</h4>
                            </div>
                            <div class="col-md-3">
                                <h4 class="add_info">Kategori</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Harga</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Hapus</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <?php foreach ($keranjangDataProvider->models as /** @var $produk Produk */ $produk): ?>
                        <div class="col-md-12">
                            <div class="single_product clearfix">
                                <div class="col-lg-5 col-md-7 v_middle">
                                    <div class="product__description">
                                        <?= Html::img('@.penjual/upload/produk/'.$produk->galeriProduks[0]->nama_berkas,['width'=>'30%','height'=>120])?>
                                        <div class="short_desc">
                                            <a href="single-product.html">
                                                <h4><?=$produk->nama?></h4>
                                            </a>
                                            <?= StringHelper::truncateWords($produk->deskripsi,20,'...',true)?>
                                        </div>
                                    </div>
                                    <!-- end /.product__description -->
                                </div>
                                <!-- end /.col-md-5 -->

                                <div class="col-lg-3 col-md-2 v_middle">
                                    <div class="product__additional_info">
                                        <ul>
                                            <?php foreach ($produk->kategoriProduk as $kategoriProduk):?>
                                            <li>
                                                   <?=$kategoriProduk->nama?>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <!-- end /.product__additional_info -->
                                </div>
                                <!-- end /.col-md-3 -->

                                <div class="col-lg-4 col-md-3 v_middle">
                                    <div class="product__price_download">
                                        <div class="item_price v_middle">
                                            <span><?=Yii::$app->formatter->asCurrency($produk->harga)?></span>
                                        </div>
                                        <div class="item_action v_middle">
                                            <?=Html::a('<span class="lnr lnr-trash"></span>',['keranjang/hapus'],['class'=>'remove_from_cart','data'=>[
                                                    'method'=>'POST',
                                                'params'=>[
                                                    'produk'=>$produk->id,
                                                    'user'=>Yii::$app->user->identity->getId()
                                                ]
                                            ]])?>
                                        </div>
                                        <!-- end /.item_action -->
                                    </div>
                                    <!-- end /.product__price_download -->
                                </div>
                                <!-- end /.col-md-4 -->
                            </div>
                            <!-- end /.single_product -->
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- end /.row -->

                    <div class="row">
                        <div class="col-md-6 offset-md-6">
                            <div class="cart_calculation">
                                <div class="cart--subtotal">
                                    <p>
                                        <span>Jumlah produk</span><?=$keranjangCount?></p>
                                </div>
                                <div class="cart--total">
                                    <p>
                                        <span>Total</span><?=Yii::$app->formatter->asCurrency($keranjangTotal)?></p>
                                </div>

                                <?=Html::a('Lanjut ke Pembayaran',['pembayaran/keranjang'],['class'=>'btn btn--round btn--md checkout_link'])?>
                             </div>
                        </div>
                        <!-- end .col-md-12 -->
                    </div>
                    <!-- end .row -->
                </div>
                <!-- end /.product_archive2 -->
            </div>
            <!-- end .col-md-12 -->
        </div>
        <!-- end .row -->

    </div>
    <!-- end .container -->
</section>
<!--================================
        END DASHBOARD AREA
=================================-->
