<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UlasanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ulasan';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="dashboard-area">
    <div class="dashboard_contents">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ulasan-index">



                        <!--    --><?php //echo $this->render('_search', ['model' => $searchModel]); ?>

                        <?= ListView::widget([
                            'summary' => false,
                            'dataProvider' => $dataProvider,
                            'itemOptions' => ['class' => 'item'],
                            'itemView' => '_item_review'
                        ]) ?>


                    </div>
                </div>
            </div>
            <!-- end /.information_module-->
        </div>
        <!-- end /.col-md-6 -->
    </div>
    <!-- end /.row -->
    <!-- end /form -->
</section>

