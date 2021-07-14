<?php

/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = 'Permintaan';
$this->params['breadcrumbs'][] = ['label' => $this->title];

use kartik\grid\GridView;

?>

<section class="section--padding">

    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?= GridView::widget(
                        [
                            'dataProvider' => $dataProvider,
                            'summary' => false,
                            'options' => [
                                'class' => 'statement_table table-responsive'
                            ],
                            'columns' => [
                                ['class' => \kartik\grid\SerialColumn::class, 'header' => 'No'],
                                'nama',
                                'harga:currency',
                                'statusString',
                                'keterangan',
                                'updated_at:datetime',
                                ['class' => \kartik\grid\ActionColumn::class, 'header' => 'Aksi', 'contentOptions' => ['class' => 'action'],
                                    'template' => '{view}']
                            ]
                        ]
                    ) ?>
                </div>
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </div>
    <!-- end /.dashboard_menu_area -->
</section>
