<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\TransaksiProduk
 */
$this->title = 'Pembelian: '.$model->code;
?>

<!--================================
             START DASHBOARD AREA
     =================================-->
<section class="dashboard-area">
    <div class="dashboard_contents">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="mb-3"><?=$this->title?></h3>
                    <div class="clearfix"></div>
                    <?=\yii\widgets\DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'code',
                            'order_date:datetime',
                            'paymentStatus',
                            'statusTransaksi',
                            'grand_total:currency',
                            'tax_amount:currency'
                        ]
                        ])?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h3 class="mb-3">Produk</h3>
                    <?=\kartik\grid\GridView::widget([
                        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getTransaksiDetails()]),
                        'summary' => false,
                        'columns' => [
                            ['class'=>\kartik\grid\SerialColumn::class,'header'=>'No'],
                            'produk.nama',
                            'base_price:currency',
                            'bargain_price:currency',
                            'discount_percent',
                            'sub_total:currency',
                            ['attribute' => 'produk.download_link','format' => 'html','value' => function($model){
                                return \yii\bootstrap4\Html::a('<i class="lnr lnr-arrow-down-circle"></i> Download',$model->produk->download_link,['class'=>'btn btn-sm btn-success']);
                            }]
                        ]
                    ])?>
                </div>
            </div>
            <!-- end /.information_module-->
        </div>
        <!-- end /.col-md-6 -->
    </div>
    <!-- end /.row -->
    <!-- end /form -->
    </div>
    <!-- end /.container -->
    </div>
    <!-- end /.dashboard_menu_area -->
</section>
<!--================================
        END DASHBOARD AREA
=================================-->
