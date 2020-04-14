<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\PermintaanProduk
 * @var $progress common\models\RiwayatPermintaan []
 */

$this->title = 'Progress Permintaan';
$this->params['breadcrumbs'][] = ['label'=>'Permintaan','url'=>['permintaan/index']];
$this->params['breadcrumbs'][] = ['label'=>$model->nama, 'url'=>['permintaan/view','id'=>$model->id]];
$this->params['breadcrumbs'][] = ['label'=>$this->title];

?>

<section class="section--padding">
    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="timeline">
                        <?php foreach ($progress as $k => $v): ?>
                        <li class="happening">
                            <div class="happening--period">
                                <p><?=Yii::$app->formatter->asDate($v->tanggal)?></p>
                            </div>
                            <div class="happening--detail">
                                <h4 class="title"><?= $v->keterangan?></h4>
                            </div>
                        </li>
                        <?php endforeach; ?>

                    </ul>
                    <!-- end /.timeline -->
                </div>
                <!-- end /.col-md-12 -->
            </div>
        </div>
        <!-- end .container -->
    </div>
</section>
