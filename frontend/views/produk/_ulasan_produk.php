<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 11/10/2019
 * Time: 8:21 PM
 */

use yii\widgets\ListView;

/**
 * @var $this yii\web\View
 * @var $ulasanSearch frontend\models\UlasanSearch
 * @var $ulasanDataProvider yii\data\ActiveDataProvider
 * @var $modelUlasan common\models\Ulasan
 */

?>


<div class="fade tab-pane product-tab" id="product-review">


    <div class="thread thread_review">

        <ul class="media-list thread-list">

            <?= ListView::widget([
                'dataProvider' => $ulasanDataProvider,
                'itemOptions' => ['class' => 'item'],
                'itemView' => '/ulasan/_item',
                'summary' => false
            ]) ?>

        </ul>
        <!-- end /.media-list -->
    </div>
    <!-- end /.comments -->
</div>
