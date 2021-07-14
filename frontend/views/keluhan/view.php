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
<section class="section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="keluhan-view">

                    <p>
                        <?= $model->status !== \common\models\Keluhan::STATUS_DIKIRIM? '': Html::a('Update', ['update',
                            'id' => $model->id], [
                            'class' => 'btn btn-round btn-md btn-info',
                        ]) ?>
                        <?= $model->status !== \common\models\Keluhan::STATUS_DIKIRIM? '': Html::a('Delete', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-round btn-md btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </p>

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'produk.nama',
                            'judul',
                            'deskripsi:html',
                            'dokumen',
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
</section>
