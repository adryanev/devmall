<?php


use frontend\models\BoothSearch;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $dataProvider ActiveDataProvider */
/* @var $modelSearch BoothSearch */
$this->title = 'Penjual';
$this->params['breadcrumbs'][] = $this->title;

?>

<!--================================
          START SIGNUP AREA
  =================================-->
<section class="bgcolor section--padding">
    <div class="shortcode_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?= $this->render('_search', ['model' => $modelSearch]) ?>

                    <div class="">
                        <?= \yii\widgets\ListView::widget([
                            'dataProvider' => $dataProvider,
                            'itemView' => '_item'
                        ]) ?>

                        <!-- end single_speaker-->
                    </div>
                    <!-- end /.event_module -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--================================
        END SIGNUP AREA
=================================-->
