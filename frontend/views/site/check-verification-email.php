<?php
/**
 * @var $this yii\web\View
 * @var $email string
 */

use yii\bootstrap4\Html;

$this->title = 'Verifikasi Email Terkirim';


?>
<section class="login_area section--padding2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="cardify login">
                    <div class="login--form">
                        <h3><?= Html::encode($this->title)?></h3>
                        <?=\yii\bootstrap4\Alert::widget(['body' =>'<p>Permintaan Verifikasi Terkirim ke : '.Html::encode($email).', bila tidak ada, '.Html::a('minta ulang verifikasi',['site/check-verification-email'],['data'=>[
                            'method'=>'POST',
                                'params'=>['ResendEmailVerificationForm[email]'=>$email]
                            ]]).'.</p>','options' => ['class'=>'alert-success'],'closeButton' => false])?>
                    </div>

                </div>

            </div>
            <!-- end .col-md-6 -->
        </div>
        <!-- end .row -->
    </div>
    <!-- end .container -->
</section>
