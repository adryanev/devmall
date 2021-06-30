<?php

/* @var $this yii\web\View */
/* @var $modelPencarian SearchProductIndexForm */
/* @var $dataKategori [] */
/* @var $newProdukDataProvider yii\data\ActiveDataProvider */


$this->title = 'Welcome to Devmall';
$colsCount = 3;

use frontend\models\forms\search\SearchProductIndexForm;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

?>

<!--================================
START HERO AREA
=================================-->
<section class="hero-area bgimage">
    <div class="bg_image_holder">
        <?= Html::img('@web/images/devmall-banner.jpg') ?>
    </div>
    <!-- start hero-content -->
    <div class="hero-content content_above">
        <!-- start .contact_wrapper -->
        <div class="content-wrapper">
            <!-- start .container -->
            <div class="container">
                <!-- start row -->

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
                        <h2>Produk Terbaru</h2>
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
                        <?php foreach ($dataKategori as $kategori) : ?>
                            <li>
                                <?= Html::a($kategori, ['produk/index', 'kategori' => $kategori]) ?>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                </div>
            </div>
            <!-- end /.col-md-12 -->
        </div>
        <!-- end /.row -->

        <!-- start .row -->
        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $newProdukDataProvider,
            'itemView' => '/produk/_search_item',
            'summary' => false,
            'itemOptions' => [
                'class' => 'col-lg-4 col-md-6'

            ],
            'beforeItem' => function ($model, $key, $index, $widget) use ($colsCount) {
                if ($index % $colsCount === 0) {
                    return "<div class='row'>";
                }
                return '';
            },
            'afterItem' => function ($model, $key, $index, $widget) use ($colsCount) {
                $content = '';
                if (($index > 0) && ($index % $colsCount === $colsCount - 1)) {
                    $content .= "</div>";
                }
                return $content;
            },
        ]);?>

        <?php if ($newProdukDataProvider->count % $colsCount !== 0) {
            echo "</div>";
        } ?>
        <!-- end /.row -->

        <!-- start .row -->
        <div class="row">
            <div class="col-md-12">
                <div class="more-product">
                    <?= Html::a('Produk Lainnya', ['produk/index', 'kategori' => ''], ['class' => 'btn btn--lg btn--round']) ?>
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

