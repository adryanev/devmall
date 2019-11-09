<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 11/9/2019
 * Time: 2:43 PM
 */

/** @var $this yii\web\View */
/** @var $model frontend\models\ProdukSearch */
/** @var $produkDataProvider yii\data\ActiveDataProvider */

$params = Yii::$app->request->getQueryParam('ProdukSearch');
$colsCount = 3;
$booth = $produkDataProvider->models[0]->booth;
$this->title = 'Produk dari ' . $booth->nama;

$this->params['breadcrumbs'][] = ['label' => 'Booth', 'url' => ['booth/index']];
$this->params['breadcrumbs'][] = ['label' => $booth->nama, 'url' => ['booth/view', 'id' => $params['id_booth']]];
$this->params['breadcrumbs'][] = $this->title
?>


<!--================================
    START PRODUCTS AREA
=================================-->
<section class="products">
    <!-- start container -->
    <div class="container">


        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $produkDataProvider,
            'itemView' => '/produk/_search_item',
            'itemOptions' => [
                'class' => 'col-lg-4 col-md-6'

            ],
            'summary' => false,
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
