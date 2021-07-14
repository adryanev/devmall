<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Keluhan */

$this->title = $model->produk->nama;
$this->params['breadcrumbs'][] = ['label' => 'Keluhan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="keluhan-view">

                        <?php if($model->status === \common\models\Keluhan::STATUS_DIKIRIM): ?>
                        <p>
                            <?= Html::a('Terima', ['terima', 'id' => $model->id], [
                                'class' => 'btn btn-round btn-md btn-success',
                                'data' => [
                                    'confirm' => 'Apakah anda yakin menerima keluhan ini?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                            <?= Html::a('Tolak', ['tolak', 'id' => $model->id], [
                                'class' => 'btn btn-round btn-md btn-danger',
                                'data' => [
                                    'confirm' => 'Apakah anda yakin menolak keluhan ini?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </p>
                        <?php endif; ?>

                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'id',
                                'produk.nama',
                                'judul',
                                'deskripsi:html',
                                ['attribute'=>'dokumen','format'=>'raw','value'=>function($model){
                                    return Html::a($model->dokumen,Yii::getAlias('@.keluhanPath/'.$model->user->id.'/'.$model->dokumen),['target'=>'_blank']);
                                }],
                                'is_installed:boolean',
                                'statusString',
                                'created_at:datetime',
                                'updated_at:datetime',
                            ],
                        ]) ?>

                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
