<?php
/* @var $this yii\web\View */
/* @var $produkDataProvider \yii\data\ActiveDataProvider */
/* @var $kategori \common\models\Kategori[] */
$params = Yii::$app->request->getQueryParam('ProdukSearch');
$this->title = 'Pencarian: ' . implode(' | ', $params);
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
                           aria-haspopup="true" aria-expanded="false">Categories
                            <span class="lnr lnr-chevron-down"></span>
                        </a>
                        <ul class="custom_dropdown custom_drop2 dropdown-menu" aria-labelledby="drop1">
                            <?php foreach ($kategori as /** @var $kat Kategori */
                                           $kat):
                                ?>
                                <li>
                                    <?= Html::a($kat->nama . '<span>' . $kat->frekuensi . '</span>', ['produk/search', 'ProdukSearch[nama]' => $params, 'ProdukSearch[kategori]' => $kat->nama]) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <!-- end /.filter__option -->


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

