<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--================================
            START LOGIN AREA
    =================================-->
<section class="login_area section--padding2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="site-login">
                    <h1><?= Html::encode($this->title) ?></h1>

                    <p>Please fill out the following fields to login:</p>

                    <div class="row">
                        <div class="col-lg-5">
                            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'password')->passwordInput() ?>

                            <?= $form->field($model, 'rememberMe')->checkbox() ?>

                            <div style="color:#999;margin:1em 0">
                                If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                                <br>
                                Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
                            </div>

                            <div class="form-group">
                                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
                <form action="#">
                    <div class="cardify login">
                        <div class="login--header">
                            <h3>Welcome Back</h3>
                            <p>You can sign in with your username</p>
                        </div>
                        <!-- end .login_header -->

                        <div class="login--form">
                            <div class="form-group">
                                <label for="user_name">Username</label>
                                <input id="user_name" type="text" class="text_field" placeholder="Enter your username...">
                            </div>

                            <div class="form-group">
                                <label for="pass">Password</label>
                                <input id="pass" type="text" class="text_field" placeholder="Enter your password...">
                            </div>

                            <div class="form-group">
                                <div class="custom_checkbox">
                                    <input type="checkbox" id="ch2">
                                    <label for="ch2">
                                        <span class="shadow_checkbox"></span>
                                        <span class="label_text">Remember me</span>
                                    </label>
                                </div>
                            </div>

                            <button class="btn btn--md btn--round" type="submit">Login Now</button>

                            <div class="login_assist">
                                <p class="recover">Lost your
                                    <a href="pass-recovery.html">username</a> or
                                    <a href="pass-recovery.html">password</a>?</p>
                                <p class="signup">Don't have an
                                    <a href="signup.html">account</a>?</p>
                            </div>
                        </div>
                        <!-- end .login--form -->
                    </div>
                    <!-- end .cardify -->
                </form>
            </div>
            <!-- end .col-md-6 -->
        </div>
        <!-- end .row -->
    </div>
    <!-- end .container -->
</section>
<!--================================
        END LOGIN AREA
=================================-->

