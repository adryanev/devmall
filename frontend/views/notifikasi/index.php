<?php

/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = 'Permintaan';
$this->params['breadcrumbs'][] = ['label' => $this->title];

use kartik\grid\GridView;

?>

<section class="dashboard-area">

    <div class="dashboard_contents dashboard_statement_area">
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
                                ['attribute' => 'sender', 'value'=>'user.username'],
                                'context',
                                'status',
                                'created_at:date',
                                ['class' => 'common\widgets\ActionColumn', 'header' => 'Aksi',
                                'template' => '{view}'],
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
