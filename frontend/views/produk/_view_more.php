<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 11/4/2019
 * Time: 7:29 PM
 */

use common\models\Produk;
use yii\web\View;

/**
 * @var $this View
 * @var $model Produk
 */

$colsCount = 3;
?>


<!--============================================
       START MORE PRODUCT ARE
   ==============================================-->
<section class="more_product_area section--padding">
    <div class="container">
        <div class="row">
            <!-- start col-md-12 -->
            <div class="col-md-12">
                <div class="section-title">
                    <h1>Lainnya dari
                        <span class="highlighted"> <?= $model->booth->nama ?></span>
                    </h1>
                </div>
            </div>
            <!-- end /.col-md-12 -->

            <?php $lainnya = $model->booth->getProduks()->orderBy(new \yii\db\Expression('RAND()'))->limit(3)->all();
            $datProv = new \yii\data\ArrayDataProvider(['allModels' => $lainnya, 'pagination' => ['pageSize' => 3]]);
            ?>
            <?= \yii\widgets\ListView::widget(
                [
                    'dataProvider' => $datProv,
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
            if ($datProv->count % $colsCount !== 0) {
                echo "</div>";
            } ?>


        </div>
        <!-- end /.container -->
    </div>
    <!-- end /.container -->
</section>
<!--============================================
    END MORE PRODUCT AREA
==============================================-->
