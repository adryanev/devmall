<?php
/* @var $this yii\web\View */
/* @var $produkDataProvider \yii\data\ActiveDataProvider */
$params = Yii::$app->request->getQueryParam('produk');
$this->title = 'Pencarian: ' . $params;
$colsCount = 3;
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
                            <?php ?>
                            <li>
                                <a href="#">Wordpress
                                    <span>35</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">Landing Page
                                    <span>45</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">Psd Template
                                    <span>13</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">Plugins
                                    <span>08</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">HTML Template
                                    <span>34</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">Components
                                    <span>78</span>
                                </a>
                            </li>
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

