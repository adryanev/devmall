<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
/* @var $this yii\web\View */
/* @var $model frontend\models\forms\user\UserLoginForm */
/* @var $form ActiveForm */
$this->title = 'Log in';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--================================
           START LOGIN AREA
   =================================-->
<section class="login_area section--padding2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <?php $form = ActiveForm::begin(['action' => ['site/login']]); ?>

                <div class="cardify login">
                        <div class="login--header">
                            <h3>Halo</h3>
                            <p>Kamu dapat masuk dengan menggunakan <i>username</i>-mu</p>
                        </div>
                        <!-- end .login_header -->

                        <div class="login--form">
                            <div class="user-login-form">



                                <?= $form->field($model, 'username')->textInput() ?>
                                <?= $form->field($model, 'password')->passwordInput() ?>
                                <?= $form->field($model, 'rememberMe')->checkbox()->label('Ingat Saya?') ?>

                                <div class="form-group">
                                    <?= Html::submitButton('Masuk   ', ['class' => 'btn btn--md btn--round']) ?>
                                </div>

                            </div><!-- user-login-form -->


                            <div class="login_assist">
                                <p class="recover">Lupa
                                    <?=Html::a('password',['site/request-password-reset'])?>
                                    ?</p>
                                <p class="signup">Tidak punya
                                    <?=Html::a('akun',['site/signup'])?>?</p>
                            </div>
                        </div>
                        <!-- end .login--form -->
                    </div>
                    <!-- end .cardify -->
                <?php ActiveForm::end(); ?>

            </div>
            <!-- end .col-md-6 -->
        </div>
        <!-- end .row -->
    </div>
    <!-- end .container -->
</section>

