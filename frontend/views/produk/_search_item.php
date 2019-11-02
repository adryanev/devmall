<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 11/2/2019
 * Time: 8:33 PM
 */

/** @var $model \common\models\Produk */

use yii\bootstrap4\Html;

?>


<!-- start .single-product -->
<div class="product product--card">

    <div class="product__thumbnail">
        <?= Html::img('@.penjual/upload/produk/' . $model->galeriProduks[0]->nama_berkas,
            ['alt' => 'Gambar Produk', 'height' => 250]) ?>
        <div class="prod_btn">
            <?= Html::a('Lebih Lanjut', ['produk/view', 'id' => $model->id], ['class' => 'transparent btn--sm btn--round']) ?>
            <?= Html::a('Demo Langsung', $model->demo, ['class' => 'transparent btn--sm btn--round', 'target' => '_blank']) ?>
        </div>
        <!-- end /.prod_btn -->
    </div>
    <!-- end /.product__thumbnail -->

    <div class="product-desc">
        <a href="#" class="product_title">
            <h4><?= Html::encode($model->nama) ?></h4>
        </a>
        <ul class="titlebtm">
            <li>
                <?= Html::img('@.penjual/upload/verifikasi/' . $model->booth->avatar, ['class' => 'auth-img', 'alt' => 'Gambar Penjual']) ?>
                <p>
                    <a href="#"><?= $model->booth->nama ?></a>
                </p>
            </li>
            <li class="product_cat">
                <?php foreach ($model->kategoriProduk as $kategoriProduk): ?>

                    <i class="lnr lnr-book"></i><a href="#">
                        <?= $kategoriProduk->nama ?></a>
                <?php endforeach; ?>
            </li>

        </ul>

        <p><?= Html::encode($model->deskripsi) ?></p>
    </div>
    <!-- end /.product-desc -->

    <div class="product-purchase">
        <div class="price_love">
            <span><?= Yii::$app->formatter->asCurrency($model->harga) ?></span>
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