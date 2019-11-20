<?php


use common\models\User;
use yii\data\ActiveDataProvider;

/** @var $dataProvider ActiveDataProvider */
/** @var $user User */
$this->title = "Produk Favorit";
$this->params['breadcrumbs'][]=$this->title;

?>

<section class="products">
    <!-- start container -->
    <div class="container">


        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_favorit_item',
            'summary' => false

        ]);
        ?>
        <!-- end /.row -->

    </div>
    <!-- end /.container -->
</section>
