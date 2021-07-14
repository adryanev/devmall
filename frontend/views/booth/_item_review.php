<?php
/**
 * @var $model Produk
 * @var $key
 * @var $index
 * @var $widget
 */

use common\models\Produk;

?>

<div class="shortcode_module_title">
    <?=\yii\bootstrap4\Html::a('<h4 class="dashboard__title">'.
        $model->nama.'
    </h4>',['produk/view','id'=>$model->id])?>


    <?=\yii\widgets\ListView::widget([
        'summary' => false,
        'dataProvider' => new \yii\data\ActiveDataProvider(['query'=>$model->getUlasans()]),
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_item_ulasan'
    ])?>
</div>
