<?php
/* @var $this yii\web\View */
/* @var $produkDataProvider \yii\data\ActiveDataProvider */
/* @var $kategori [common\models\Kategori] */
$params = Yii::$app->request->getQueryParam('produk');
$this->title = 'Produk';
$colsCount = 3;

use common\models\Kategori;
use yii\bootstrap4\Html;

?>

<!--================================
    START FILTER AREA
=================================-->
<div class="filter-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="filter-bar">
                    <div class="filter__option filter--dropdown">
                        <a href="#" id="drop1" class="dropdown-trigger dropdown-toggle" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">Kategori
                            <span class="lnr lnr-chevron-down"></span>
                        </a>
                        <ul class="custom_dropdown custom_drop2 dropdown-menu" aria-labelledby="drop1">
                            <?php foreach ($kategori as /** @var $kat Kategori */
                                           $kat): ?>
                                <li>
                                    <?= Html::a($kat->nama . '<span>' . $kat->frekuensi . '</span>', ['produk/index', 'ProdukSearch[kategori]' => $kat->nama]) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    </div>
                    <!-- end /.filter__option -->
                    <div class="filter__option filter--select">
                        <div class="select-wrap">
                            <select name="price" id="sort-harga">
                                <option value="harga"<?= Yii::$app->request->getQueryParam('sort') == 'harga' ? 'selected' : '' ?> >
                                    Harga : Rendah ke
                                    Tinggi
                                </option>
                                <option value="-harga" <?= Yii::$app->request->getQueryParam('sort') == '-harga' ? 'selected' : '' ?>>
                                    Harga : Tinggi ke Rendah
                                </option>
                            </select>
                            <span class="lnr lnr-chevron-down"></span>
                        </div>
                    </div>
                    <?php
                    $params = Yii::$app->request->queryParams;

                    $jsSortHarga = <<<JS

                        $('#sort-harga').on('change',function(){
                            const regex = /&sort=(?:-?)harga/g;
                            var url  = window.location.href;
                            var select = $('#sort-harga option:selected').val();
                            var newUrl = url.replace(regex,'')


                           window.location.href=newUrl+"&sort="+select;

                        });

JS;
                    $this->registerJs($jsSortHarga);

                    ?>


                </div>
                <!-- end /.filter-bar -->
            </div>
            <!-- end /.col-md-12 -->
        </div>
        <!-- end filter-bar -->
    </div>
</div>
<!-- end /.filter-area -->
<!--================================
    END FILTER AREA
=================================-->


<!--================================
    START PRODUCTS AREA
=================================-->
<section class="products">
    <!-- start container -->
    <div class="container">


        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $produkDataProvider,
            'itemView' => '_search_item',
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
        ]);
        if ($produkDataProvider->count % $colsCount !== 0) {
            echo "</div>";
        } ?>
        <!-- end /.row -->

    </div>
    <!-- end /.container -->
</section>
<!--================================
    END PRODUCTS AREA
=================================-->

