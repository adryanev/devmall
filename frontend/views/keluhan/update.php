<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Keluhan */
/* @var $uploadModel \frontend\models\forms\KeluhanUploadForm */

$this->title = 'Update Keluhan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Keluhans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<section class="section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="keluhan-update">

                    <h1><?= Html::encode($this->title) ?></h1>

                    <?= $this->render('_form', [
                        'model' => $model,
                        'uploadModel'=>$uploadModel
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</section>

