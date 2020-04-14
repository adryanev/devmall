<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\forms\user\UserSignupForm */
/* @var $form ActiveForm */

$this->title = 'Daftar';
$this->params['breadcrumbs'][] = $this->title;
?>

<!--================================
           START SIGNUP AREA
   =================================-->
<section class="signup_area section--padding2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <?php $form = ActiveForm::begin(); ?>
                    <div class="cardify signup_form">
                        <div class="login--header">
                            <h3>Buat Akun Anda</h3>
                            <p>Mohon isi data berikut ini dengan benar untuk mendaftar di <?=Yii::$app->name?>.
                            </p>
                        </div>
                        <!-- end .login_header -->

                        <div class="login--form">

                            <div class="user-signup-form">


                                <?= $form->field($model, 'username')->textInput() ?>
                                <?= $form->field($model, 'email')->textInput() ?>
                                <?= $form->field($model, 'password')->passwordInput() ?>
                                <?= $form->field($model, 'nama_depan')->textInput() ?>
                                <?= $form->field($model, 'nama_belakang')->textInput() ?>
                                <?= $form->field($model, 'agreement',['template'=>'{input}{label}{error}'])->checkbox()->label(' Saya setuju dengan '.Html::a('Terms of Service',['site/tos']).' di Website ini.') ?>

                                <div class="form-group">
                                    <?= Html::submitButton('Submit', ['class' => 'btn btn--md btn--round register_btn']) ?>
                                </div>

                            </div><!-- user-signup-form -->


                            <div class="login_assist">
                                <p>Sudah Punya akun?
                                    <?=Html::a('Login',['site/login'])?>
                                </p>
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
<!--================================
        END SIGNUP AREA
=================================-->
