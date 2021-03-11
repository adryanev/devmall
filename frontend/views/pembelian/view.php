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
