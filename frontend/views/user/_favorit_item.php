<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 11/2/2019
 * Time: 8:33 PM
 */

/** @var $model Favorit */

use common\models\Favorit;
use kartik\rating\StarRating;
use yii\bootstrap4\Html;

?>

<!-- start .single-product -->
<div class="product product--list">

    <div class="product__thumbnail">
        <?= Html::img('@.penjual/upload/produk/' . $model->produk->galeriProduks[0]->nama_berkas,
            ['alt' => 'Gambar Produk', 'height' => 250]) ?>
        <div class="prod_btn">
            <div class="prod_btn__wrap">
                <?= Html::a('Lebih Lanjut', ['produk/view', 'id' => $model->produk->id], ['class' => 'transparent btn--sm btn--round']) ?>
            </div>
            <div class="prod_btn__wrap">
                <?= Html::a('Demo Langsung', $model->produk->demo, ['class' => 'transparent btn--sm btn--round', 'target' => '_blank']) ?>
            </div>

        </div>
        <!-- end /.prod_btn -->
    </div>
    <!-- end /.product__thumbnail -->

    <div class="product__details">
        <div class="product-desc">
            <?= Html::a('<h4>' . Html::encode($model->produk->nama) . '</h4>', ['produk/view', 'id' => $model->produk->id], ['class' => 'product_title']) ?>
            <p><?=

                \yii\helpers\StringHelper::truncateWords($model->produk->deskripsi, 50, '...', true) ?></p>

            <ul class="titlebtm">
                <li class="product_cat">
                    <?php foreach ($model->produk->kategoriProduk as $kategoriProduk): ?>

                        <i class="lnr lnr-book"></i>
                        <?= Html::a($kategoriProduk->nama, ['produk/search', 'ProdukSearch[kategori]' => $kategoriProduk->nama]) ?>


                    <?php endforeach; ?>
                </li>
            </ul>
        </div>
        <!-- end /.product-desc -->

        <div class="product-meta">
            <div class="author">
                <?= Html::img('@.penjual/upload/verifikasi/' . $model->produk->booth->avatar, ['class' => 'auth-img', 'alt' => 'Gambar Penjual']) ?>
                <p>
                    <?= Html::a($model->produk->booth->nama, ['booth/view', 'id' => $model->produk->booth->id]) ?>
                </p>
            </div>

            <div class="love-comments">
                <p>
                    <span class="lnr lnr-heart"></span><?= $model->produk->getFavorits()->count() ?></p>
            </div>


            <div class="rating product--rating">
                <?= StarRating::widget([
                    'name' => 'ulasan_produk_sidebar',
                    'value' => $model->produk->nilaiUlasan,
                    'pluginOptions' => [
                            'size'=>'xs',
                        'displayOnly' => true,
                        'theme' => 'krajee-fas',
                    ]]) ?>

                <span class="rating__count">(<?= $model->produk->getUlasans()->count() ?> Ulasan)</span>
            </div>
        </div>
        <!-- end product-meta -->

        <div class="product-purchase">
            <div class="price_love">
                <span><?= Yii::$app->formatter->asCurrency($model->produk->harga) ?></span>
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
</div>
<!-- end /.single-product -->

<!-- start .single-product -->
