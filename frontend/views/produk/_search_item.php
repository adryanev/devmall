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
        <?php 
            if (count($model->galeriProduks)>0) {
?>
        <?= Html::img('@.penjual/upload/produk/' . $model->galeriProduks[0]->nama_berkas,
            ['alt' => 'Gambar Produk', 'height' => 250]) ?>
<?php                
            }else{
?>
        <?= Html::img('@.penjual/upload/produk/no_image_alternatig.PNG',
            ['alt' => 'Gambar Produk', 'height' => 250]) ?>
<?php                
            }
         ?>

        <div class="prod_btn">
            <?= Html::a('Lebih Lanjut', ['produk/view', 'id' => $model->id], ['class' => 'transparent btn--sm btn--round']) ?>
            <?= Html::a('Demo Langsung', $model->demo, ['class' => 'transparent btn--sm btn--round', 'target' => '_blank']) ?>
        </div>
        <!-- end /.prod_btn -->
    </div>
    <!-- end /.product__thumbnail -->

    <div class="product-desc">
        <?= Html::a('<h4>' . Html::encode($model->nama) . '</h4>', ['produk/view', 'id' => $model->id], ['class' => 'product_title']) ?>
        <ul class="titlebtm">
            <li>
                <?= Html::img('@.penjual/upload/verifikasi/' . $model->booth->avatar, ['class' => 'auth-img', 'alt' => 'Gambar Penjual']) ?>
                <p>
                    <?= Html::a($model->booth->nama, ['booth/view', 'id' => $model->booth->id]) ?>
                </p>
            </li>
            <li class="product_cat">
                <?php foreach ($model->kategoriProduk as $kategoriProduk): ?>

                    <i class="lnr lnr-book"></i>
                    <?= Html::a($kategoriProduk->nama, ['produk/search', 'ProdukSearch[kategori]' => $kategoriProduk->nama]) ?>


                <?php endforeach; ?>
            </li>

        </ul>

        <p><?=

            \yii\helpers\StringHelper::truncateWords($model->deskripsi, 50, '...', true) ?></p>
    </div>
    <!-- end /.product-desc -->

    <div class="product-purchase" style="text-align: center">
        <div class="price_love" style="display: inline-block">
            <?php if ($model->diskon) : ?>
                <small style="font-size: 8pt;">
                    <del><?= Yii::$app->formatter->asCurrency($model->harga) ?></del>
                </small>
                <br>
                <span style="font-size: 14pt"><?= Yii::$app->formatter->asCurrency($model->hargaDiskon) ?></span>
            <?php else: ?>
                <span style="font-size: 14pt"><?= Yii::$app->formatter->asCurrency($model->harga) ?></span>
            <?php endif; ?>

        </div>
        <div class="clearfix"></div>
        <br>
        <div class="sell">
            <p>
                <span class="lnr lnr-heart"></span> <?= $model->getFavorits()->count() ?></p>
            <p>
                <span class="lnr lnr-cart"></span>
                <span>16</span>
            </p>
        </div>
    </div>
    <!-- end /.product-purchase -->
</div>
<!-- end /.single-product -->