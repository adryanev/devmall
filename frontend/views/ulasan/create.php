<?php
$this->title = 'Ulasan: '.$model->produk->nama
?>

<section class="section--padding">

    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4><?=$this->title?></h4>

                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-lg-12 pull-right">
                    <?=$this->render('_form',['model'=>$model])?>
                </div>
            </div>
        </div>
        <!-- end /.container -->
    </div>
    <!-- end /.dashboard_menu_area -->
</section>
