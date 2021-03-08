<?php

/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 11/4/2019
 * Time: 7:21 PM
 */


use common\models\Produk;
use demogorgorn\ajax\AjaxSubmitButton;
use kartik\rating\StarRating;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Carousel;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
use yii\helpers\ArrayHelper;
use yii\web\View;

/**
 * @var $this View
 * @var $model Produk
 * @var $ulasanSearch frontend\models\UlasanSearch
 * @var $ulasanDataProvider yii\data\ActiveDataProvider
 * @var $modelUlasan common\models\Ulasan
 * @var $modelNego \frontend\models\forms\nego\NegoForm
 */



$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Produk', 'url' => ['produk/index', 'kategori' => '']];
$this->params['breadcrumbs'][] = $this->title;

$arrayGambar = ArrayHelper::map($model->galeriProduks, 'id', 'nama_berkas');
$dataGambar = array_values($arrayGambar);
$gams = [];
foreach ($dataGambar as $gamber) {
    $gams[] = Html::img(Yii::getAlias('@.produkPath/' . $gamber), ['class' => 'mx-auto d-block carousel']);
}
?>

    <!--============================================
           START SINGLE PRODUCT DESCRIPTION AREA
       ==============================================-->
    <section class="single-product-desc">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <?= Carousel::widget([
                        'items' => $gams,
                        'showIndicators' => true,
                    ]) ?>
                    <div class="item-preview">
                        <div class="item__preview-slider">
                        </div>
                        <!-- end /.item--preview-slider -->

                        <div class="item__preview-thumb">
                            <div class="prev-thumb">

                                <!-- end /.prev-nav -->
                            </div>

                            <div class="item-action">
                                <div class="action-btns">
                                    <?= Html::a('<span class="lnr lnr-link"></span> Demo', $model->demo, ['class' => 'btn btn--round btn--lg btn-light', 'target' => '_blank']) ?>
                                    <?php if (!Yii::$app->user->isGuest): ?>
                                        <?php if (Yii::$app->user->identity->isFavoriting($model->id)): ?>
                                            <?= Html::a('<span class="lnr lnr-heart"></span>Hapus dari Favorit', ['favorit/remove', 'id' => $model->id], ['class' => 'btn btn-danger btn--round btn--lg btn--icon', 'data' => [
                                                'method' => 'POST',
                                                'params' => ['user' => Yii::$app->user->identity->getId()]
                                            ]]) ?>
                                        <?php else: ?>
                                            <?= Html::a('<span class="lnr lnr-heart"></span>Tambah ke Favorit', ['favorit/add', 'id' => $model->id], ['class' => 'btn btn-secondary btn--round btn--lg btn--icon', 'data' => [
                                                'method' => 'POST',
                                                'params' => ['user' => Yii::$app->user->identity->getId()]
                                            ]]) ?>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?= Html::a('<i class="fab fa-whatsapp"></i> Hubungi Penjual', 'https://api.whatsapp.com/send?phone=' . $model->booth->nomor_telepon, ['class' => 'btn btn--round btn--lg btn--icon btn-success', 'target' => '_blank']) ?>
                                </div>
                            </div>
                            <!-- end /.item__action -->
                        </div>
                        <!-- end /.item__preview-thumb-->


                    </div>
                    <!-- end /.item-preview-->

                    <div class="item-info">
                        <div class="item-navigation">
                            <ul class="nav nav-tabs">
                                <li>
                                    <a href="#product-details" class="active" aria-controls="product-details" role="tab"
                                       data-toggle="tab">Detail Produk</a>
                                </li>
                                <li>
                                    <a href="#product-review" aria-controls="product-review" role="tab"
                                       data-toggle="tab">Ulasan
                                        <span>(<?= $model->getUlasans()->count() ?>)</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- end /.item-navigation -->

                        <div class="tab-content">
                            <div class="fade show tab-pane product-tab active" id="product-details">
                                <div class="tab-content-wrapper">
                                    <h3>Deskripsi</h3>
                                    <br>
                                    <?= $model->deskripsi ?>
                                    <hr>
                                    <h3>Fitur</h3>
                                    <br>
                                    <?= $model->fitur ?>
                                    <hr>
                                    <h3>Spesifikasi</h3>
                                    <br>
                                    <?= $model->spesifikasi ?>
                                </div>
                            </div>
                            <!-- end /.tab-content -->


                            <?= $this->render('_ulasan_produk', compact('modelUlasan', 'ulasanDataProvider', 'ulasanSearch')) ?>
                            <!-- end /.product-comment -->
                        </div>
                        <!-- end /.tab-content -->
                    </div>
                    <!-- end /.item-info -->
                </div>
                <!-- end /.col-md-8 -->

                <div class="col-lg-4">
                    <aside class="sidebar sidebar--single-product">
                        <?php if ($model->diskon): ?>
                            <div class="sidebar-card card-pricing card--pricing2">
                                <div class="price">
                                    <h1>
                                        <span><?= Yii::$app->formatter->asCurrency($model->hargaDiskon) ?></span>
                                    </h1>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="sidebar-card card-pricing">
                            <div class="price">
                                <h1>
                                    <?php if ($model->diskon): ?>
                                        <del><?= Yii::$app->formatter->asCurrency($model->harga) ?></del>
                                    <?php else: ?>
                                        <?= Yii::$app->formatter->asCurrency($model->harga) ?>
                                    <?php endif; ?>
                                </h1>
                            </div>

                            <div class="purchase-button">


                                <?php if (!Yii::$app->user->isGuest): ?>
                                    <?php if ($model->nego && !$model->diskon): ?>
                                        <?php Modal::begin([
                                            'id' => 'modalNego',
                                            'title' => 'Negosiasi',
                                            'toggleButton' => ['label' => '<span class="fas fa-comments-dollar"></span> Nego', 'class' => 'btn btn--lg btn--round cart-btn btn-warning']
                                        ]) ?>

                                        <?php $form = ActiveForm::begin(['id' => 'nego-form', 'action' => ['nego/add']]) ?>
                                        <?= $form->field($modelNego, 'produk')->hiddenInput()->label(false) ?>


                                        <?= $form->field($modelNego, 'harga')->textInput(['type' => 'number']) ?>
<?php

                                if (isset(Yii::$app->session['jumlahNego'])) {

                                    if (Yii::$app->session['jumlahNego'] != 4) {
    ?>
                                        <span class="text-danger">Harga Terlalu Rendah !</span>
    <?php
                                    }else{
    ?>
                                        <span class="text-danger">Batas Nego Produk Telah Habis Utk Hari Ini !</span>
    <?php
                                    }
                                }
 ?>

                                        <div class="form-group">
                                            <?= Html::submitButton('<i class=\'la la-save\'></i> Nego', ['class' => 'btn btn-pill btn-elevate btn-elevate-air btn-brand']) ?>
                                        </div>

                                        <?php ActiveForm::end() ?>
                                        <?php Modal::end() ?>
                                    <?php endif; ?>
                                <?php endif; ?>

<?php
                                if (!Yii::$app->user->isGuest){

                                    echo Html::a(' <span class="fas fa-shopping-bag"></span> Beli Sekarang', ['pembayaran/belisekarang'], ['class' => 'btn btn--lg btn--round btn-info', 'data' => [
                                        'method' => 'POST',
                                        'params' => [
                                            'produk' => $model->id,
                                            'user' => Yii::$app->user->identity->getId(),
                                            'is_diskon' => isset($model->diskon->id),
                                            'is_nego' => isset($model->nego0->id)
                                        ]
                                    ]]);

                                }else{

                                    echo  Html::a('<span class="fas fa-shopping-bag">Beli Sekarang</span>', ['site/login'], ['class' => 'btn btn--lg btn--round btn-info']);



                                }
?>


                                <?php if (!Yii::$app->user->isGuest): ?>
                                    <?php
                                    $cart = Yii::$app->cart;
                                    $keranjs = $cart->getItemById($model->id);
                                    if (!$keranjs): ?>
                                        <?= Html::a(' <span class="lnr lnr-cart"></span> Tambah ke Keranjang', ['keranjang/tambah'], ['class' => 'btn btn--lg btn--round cart-btn', 'data' => [
                                            'method' => 'POST',
                                            'params' => [
                                                'produk' => $model->id,
                                                'user' => Yii::$app->user->identity->getId(),
                                                'is_diskon' => isset($model->diskon),
                                                'is_nego' => isset($model->nego0)
                                            ]
                                        ]]) ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <!-- end /.purchase-button -->
                        </div>

                        <!-- end /.sidebar--card -->

                        <div class="sidebar-card card--metadata">
                            <ul class="data">
                                <li>
                                    <p>
                                        <span class="lnr lnr-cart pcolor"></span>Total Terjual</p>
                                    <span><?= $totalTerjual ?></span>
                                </li>
                                <li>
                                    <p>
                                        <span class="lnr lnr-heart scolor"></span>Difavoritkan</p>
                                    <span><?= $model->getFavorits()->count() ?></span>
                                </li>
                            </ul>


                            <div class="rating product--rating">
                                <?= StarRating::widget([
                                    'name' => 'ulasan_produk_sidebar',
                                    'value' => $model->nilaiUlasan,
                                    'pluginOptions' => [
                                        'displayOnly' => true,
                                        'theme' => 'krajee-fas',
                                    ]
                                ]) ?>
                                <span class="rating__count">(<?= $model->getUlasans()->count() ?> Ulasan)</span>
                            </div>
                            <!-- end /.rating -->
                        </div>
                        <!-- end /.sidebar-card -->

                        <div class="sidebar-card card--product-infos">
                            <div class="card-title">
                                <h4>Product Information</h4>
                            </div>

                            <ul class="infos">
                                <li>
                                    <p class="data-label">Dirilis</p>
                                    <p class="info"><?= Yii::$app->formatter->asDate($model->created_at) ?></p>
                                </li>
                                <li>
                                    <p class="data-label">Diperbaharui</p>
                                    <p class="info"><?= Yii::$app->formatter->asDate($model->updated_at) ?> </p>
                                </li>
                                <li>
                                    <p class="data-label">Kategori</p>
                                    <p class="info text-info">
                                        <?php
                                        $kategoriProduk = ArrayHelper::map($model->kategoriProduk, 'id', 'nama');
                                        echo implode(', ', $kategoriProduk) ?>

                                    </p>
                                </li>
                                <li>
                                    <p class="data-label"> Buku Panduan</p>
                                    <p class="info"><?= empty($model->manual) ? 'Tidak' : 'Ya' ?></p>
                                </li>
                            </ul>
                        </div>
                        <!-- end /.aside -->

                        <div class="author-card sidebar-card ">
                            <div class="card-title">
                                <h4>Informasi Penjual</h4>
                            </div>

                            <div class="author-infos">
                                <div class="author_avatar">
                                    <?= Html::img('@.penjual/upload/verifikasi/' . $model->booth->avatar) ?>
                                </div>

                                <div class="author">
                                    <h4><?= $model->booth->nama ?></h4>
                                    <p>Bergabung
                                        Sejak: <?= Yii::$app->formatter->asDate($model->booth->created_at) ?></p>
                                </div>
                                <!-- end /.author -->


                                <div class="author-btn">
                                    <?= Html::a('Lihat Penjual', ['booth/view', 'id' => $model->booth->id], ['class' => 'btn btn--sm btn--round']) ?>
                                    <?= Html::a('Kirim Pesan', ['booth/message', 'id' => $model->booth->id], ['class' => 'btn btn--sm btn--round']) ?>
                                </div>
                                <!-- end /.author-btn -->
                            </div>
                            <!-- end /.author-infos -->


                        </div>
                        <!-- end /.author-card -->
                    </aside>
                    <!-- end /.aside -->
                </div>
                <!-- end /.col-md-4 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--===========================================
        END SINGLE PRODUCT DESCRIPTION AREA
    ===============================================-->
<?php

if (isset(Yii::$app->session['jumlahNego'])) {

    $js = <<<JS

    $(document).ready(function(){

            $('#modalNego').modal();

        });

    JS;

    $this->registerJs($js);

}

    unset($_SESSION['jumlahNego']);

?>

<?= $this->render('_view_more', ['model' => $model]) ?>
