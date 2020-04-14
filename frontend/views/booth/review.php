<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UlasanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ulasan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ulasan-index">



<!--    --><?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
        },
    ]) ?>


</div>
