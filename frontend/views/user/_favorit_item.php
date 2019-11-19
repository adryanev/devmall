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
use yii\bootstrap4\Html;

?>


<!-- start .single-product -->
<div class="product product--card">

    <div class="product__thumbnail">
        <?= Html::img('@.penjual/upload/produk/' . $model->produk->galeriProduks[0]->nama_berkas,
            ['alt' => 'Gambar Produk', 'height' => 250]) ?>
        <div class="prod_btn">
            <?= Html::a('Lebih Lanjut', ['produk/view', 'id' => $model->produk->id], ['class' => 'transparent btn--sm btn--round']) ?>
            <?= Html::a('Demo Langsung', $model->produk->demo, ['class' => 'transparent btn--sm btn--round', 'target' => '_blank']) ?>
        </div>
        <!-- end /.prod_btn -->
    </div>
    <!-- end /.product__thumbnail -->

    <div class="product-desc">
        <?= Html::a('<h4>' . Html::encode($model->produk->nama) . '</h4>', ['produk/view', 'id' => $model->produk->id], ['class' => 'product_title']) ?>
        <ul class="titlebtm">
            <li>
                <?= Html::img('@.penjual/upload/verifikasi/' . $model->produk->booth->avatar, ['class' => 'auth-img', 'alt' => 'Gambar Penjual']) ?>
                <p>
                    <?= Html::a($model->produk->booth->nama, ['booth/view', 'id' => $model->produk->booth->id]) ?>
                </p>
            </li>
            <li class="product_cat">
                <?php foreach ($model->produk->kategoriProduk as $kategoriProduk): ?>

                    <i class="lnr lnr-book"></i>
                    <?= Html::a($kategoriProduk->nama, ['produk/search', 'ProdukSearch[kategori]' => $kategoriProduk->nama]) ?>


                <?php endforeach; ?>
            </li>

        </ul>

        <p><?=

            \yii\helpers\StringHelper::truncateWords($model->produk->deskripsi, 50, '...', true) ?></p>
    </div>
    <!-- end /.product-desc -->

    <div class="product-purchase">
        <div class="price_love">
            <span><?= Yii::$app->formatter->asCurrency($model->produk->harga) ?></span>
            <p>
                <span class="lnr lnr-heart"></span> <?= $model->produk->getFavorits()->count() ?></p>
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