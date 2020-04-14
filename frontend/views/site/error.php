<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<section class="four_o_four_area section--padding2">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <div class="not_found">
                    <h3><?= Html::encode($this->title) ?></h3>
                    <div class="alert alert-danger">
                        <?= nl2br(Html::encode($message)) ?>
                    </div>
                    <?= Html::a('Kembali', ['site/index'], ['class' => 'btn btn--round btn--default']) ?>
                </div>
            </div>
        </div>
    </div>
</section>

