<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Keluhan';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="section--padding">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="keluhan-index">

                        <h1><?= Html::encode($this->title) ?></h1>

                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

//                                'id',
//                                'id_user',
                                ['attribute' => 'produk.nama','label' => 'Nama Produk'],
                                'judul',
                                'deskripsi',
                                //'dokumen',
                                //'is_installed',
                                ['attribute' => 'statusString','label' => 'Status'],
//                                'created_at:datetime',
                                'updated_at:datetime',

                                ['class' => \common\widgets\ActionColumn::class,'template' => '{view}'],
                            ],
                        ]); ?>


                    </div>
                </div>
            </div>
        </div>

</section>

