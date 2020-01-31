<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\PermintaanProduk
 */

$this->title = $model->booth->nama . '-' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Booth', 'url' => ['booth/view', 'id' => $model->id_booth]];
$this->params['breadcrumbs'][] = ['label' => $this->title];


?>

<section class="dashboard-area dashboard_purchase">

    <div class="dashboard_contents">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="modules__content">
                        <h4>Permintaan</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <?= \yii\widgets\DetailView::widget(
                                    [
                                        'model' => $model,
                                        'attributes' => [
                                            'id',
                                            [
                                                'label' => 'Nama Booth',
                                                'attribute' => 'booth.nama'
                                            ],
                                            [
                                                'label' => 'Nama Pemesan',
                                                'attribute' => 'user.profilUser.namaLengkap'
                                            ],
                                            'nama',
                                            'statusString',
                                            'kriteria:html',
                                            'deadline:date',
                                            'harga:currency',
                                            'uang_muka:currency',
                                        ]
                                    ]
                                ) ?>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Berkas Pendukung</h4>
                                <div class="clearfix"></div>
                                <br>
                                <?= \yii\grid\GridView::widget(
                                    [
                                        'dataProvider' => new \yii\data\ActiveDataProvider([
                                            'query' => $model->getPermintaanProdukDetails()
                                        ]),
                                        'columns' => [
                                            ['attribute' => 'nama_berkas',
                                                'value' => function ($model) {
                                                    return \yii\bootstrap4\Html::a($model->nama_berkas, Yii::getAlias('@.permintaanPath/' . $model->nama_berkas));
                                                }, 'format' => 'html']
                                        ],
                                        'summary' => false
                                    ]
                                ) ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end /.container -->
    </div>
    <!-- end /.dashboard_menu_area -->
</section>
