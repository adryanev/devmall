<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\PermintaanProduk
 * @var $unpaid int
 */

use common\models\PermintaanProduk;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\widgets\DetailView;

$this->title = $model->booth->nama.'-'.$model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Permintaan', 'url' => ['permintaan/index']];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>

<section class="section--padding">

    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4>Permintaan</h4>

                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-lg-12 pull-right">
                    <?php if ($model->status === PermintaanProduk::STATUS_DIKIRIM): ?>
                        <?= Html::a('Ubah Permintaan', ['permintaan/update', 'id' => $model->id],
                            ['class' => 'btn btn-md btn-info btn--round']) ?>
                        <?= Html::a('Hapus Permintaan', ['permintaan/delete', 'id' => $model->id],
                            ['class' => 'btn btn-md btn-danger btn--round']) ?>
                    <?php endif; ?>

                    <?php if ($unpaid): ?>
                        <?= Html::a('Selesaikan Pembayaran', ['pembayaran/permintaan'], [
                            'class' => 'btn btn-md btn-success btn--round',
                            'data' => [
                                'method' => 'POST',
                                'params' => ['id' => $model->id]
                            ]
                        ]) ?>
                    <?php endif; ?>

                    <?= $model->status === PermintaanProduk::STATUS_DIKERJAKAN ? Html::a('Lihat Progress',['permintaan/progress','id'=>$model->id],['class'=>'btn btn-md btn-info btn--round']) : ''?>

                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="modules__content">
                        <div class="row">
                            <div class="col-lg-12">
                                <?= DetailView::widget(
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
                                <?= GridView::widget(
                                    [
                                        'dataProvider' => new ActiveDataProvider([
                                            'query' => $model->getPermintaanProdukDetails()
                                        ]),
                                        'columns' => [
                                            [
                                                'attribute' => 'nama_berkas',
                                                'value' => function ($model) {
                                                    return Html::a($model->nama_berkas,
                                                        Yii::getAlias('@.permintaanPath/'.$model->nama_berkas));
                                                },
                                                'format' => 'html'
                                            ],
                                            ['class'=>\common\widgets\ActionColumn::class,'template' => '{delete}',
                                                'buttons' =>[
                                                    'delete'=> function ($url, $model, $key){
                                                        return Html::a('Hapus',['permintaan/delete-file','id'=>$model->id],['class'=>'btn btn-danger btn-round btn-md','data-method'=>'POST','data-confirm'=>'Apakah anda yakin menghapus item ini?']);
                                                    }
                                                ]]
                                        ],
                                        'summary' => false
                                    ]
                                ) ?>
                            </div>
                        </div>
                        <?php if ($model->transaksiPermintaan) :

                            ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Progress Pengerjaan</h4>
                                <ul class="timeline mb-4">
                                    <?php foreach ($model->riwayatPermintaans as $riwayat):?>
                                        <li class="happening">
                                            <div class="happening--period">
                                                <p><?=Yii::$app->formatter->asDate($riwayat->tanggal)?></p>
                                            </div>
                                            <div class="happening--detail">
                                                <h4 class="title"><?=$riwayat->keterangan?></h4>
                                            </div>
                                        </li>
                                    <?php endforeach;?>
                                    </ul>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Riwayat Pembayaran</h4>
                                <?=GridView::widget([
                                    'dataProvider' => new ActiveDataProvider(['query' => $model->transaksiPermintaan->getRiwayatTransaksiPermintaans()]),
                                    'summary' => false,
                                    'columns' => [
                                        ['class'=>SerialColumn::class,'header' => 'No'],
                                        ['attribute' =>'created_at',
                                            'format' => 'datetime',
                                            'label' => 'Tanggal'],
                                        'nominal:currency',
                                        'jenisString',
                                        'statusString',
                                    ]
                                ])?>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
        <!-- end /.container -->
    </div>
    <!-- end /.dashboard_menu_area -->
</section>
