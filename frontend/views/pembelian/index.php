<?php
/**
 * @var $this yii\web\View
 * @var $transaksiProduk yii\data\ActiveDataProvider
 */
$this->title = 'Pembelian';
?>

<!--================================
             START DASHBOARD AREA
     =================================-->
<section class="dashboard-area">
    <div class="dashboard_contents">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="mb-3">Transaksi Produk.</h3>
                    <div class="clearfix"></div>
                    <?=\kartik\grid\GridView::widget([
                        'dataProvider' => $transaksiProduk,
                        'summary' => false,
                        'columns' => [
                            ['class'=>\kartik\grid\SerialColumn::class,'header' => 'No'],
                            'code',
                            'order_date:datetime',
                            'paymentStatus',
                            'statusTransaksi',
                            ['class'=>\common\widgets\ActionColumn::className(),'header'=>'Aksi',
                                'template' => '{view}']
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
</section>
<!--================================
        END DASHBOARD AREA
=================================-->
