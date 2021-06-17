<?php
/**
 * @var $this \yii\web\View
 * @var $order \common\models\Transaksi
 */
?>

<!--================================
             START DASHBOARD AREA
     =================================-->
<section class="dashboard-area">
    <div class="dashboard_contents">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?=\common\widgets\Alert::widget()?>

                    <h3>Transaksi Anda Sedang Diproses.</h3>
                    <?=\yii\bootstrap4\Html::a('Kembali ke halaman utama',['site/index'],['class'=>'btn btn-md btn-success btn-round'])?>
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
