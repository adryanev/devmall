<?php


use common\models\User;
use yii\data\ActiveDataProvider;

/** @var $dataProvider ActiveDataProvider */
/** @var $user User */
$this->title = "Produk Favorit";
$this->params['breadcrumbs'][]=$this->title;
$colsCount = 3;

?>

<section class="products">
    <!-- start container -->
    <div class="container">


        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_favorit_item',
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
        if ($dataProvider->count % $colsCount !== 0) {
            echo "</div>";
        } ?>
        <!-- end /.row -->

    </div>
    <!-- end /.container -->
</section>
