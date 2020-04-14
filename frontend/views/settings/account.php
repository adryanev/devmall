<?php
/* @var $this yii\web\View */
/* @var $modelInformasi InformasiPribadiForm */
/* @var $modelPassword GantiPasswordForm */
/* @var $modelProfil FotoProfilForm */
/* @var $modelHp VerifikasiNomorHpForm */
/* @var $modelAlamat AlamatForm */
/* @var $modelVerifikasi VerifikasiForm */
/* @var $verifikasiSekarang VerifikasiUser */

$this->title = 'Akun';
$this->params['breadcrumbs'][] = 'Pengaturan';
$this->params['breadcrumbs'][] = $this->title;

use common\models\VerifikasiUser;
use frontend\models\forms\setting\AlamatForm;
use frontend\models\forms\setting\FotoProfilForm;
use frontend\models\forms\setting\GantiPasswordForm;
use frontend\models\forms\setting\InformasiPribadiForm;
use frontend\models\forms\setting\VerifikasiForm;
use frontend\models\forms\setting\VerifikasiNomorHpForm;

?>
<!--================================
         START DASHBOARD AREA
 =================================-->
<section class="dashboard-area">
    <!-- end /.dashboard_menu_area -->

    <div class="dashboard_contents">
        <div class="container">



                <div class="row">
                    <div class="col-lg-6">
                        <div class="information_module">
                            <a class="toggle_title" href="#collapse-info" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                <h4>Informasi Pribadi
                                    <span class="lnr lnr-chevron-down"></span>
                                </h4>
                            </a>

                            <div class="information__set toggle_module collapse" id="collapse-info">
                                <div class="information_wrapper form--fields">

                                    <?=$this->render('_informasi_pribadi_form',['model'=>$modelInformasi])?>

                                </div>
                                <!-- end /.information_wrapper -->
                            </div>
                            <!-- end /.information__set -->
                        </div>
                        <!-- end /.information_module -->

                        <div class="information_module">
                            <a class="toggle_title" href="#collapse-password" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                <h4>Ubah Password
                                    <span class="lnr lnr-chevron-down"></span>
                                </h4>
                            </a>

                            <div class="information__set toggle_module collapse" id="collapse-password">
                                <div class="information_wrapper form--fields">

                                    <?=$this->render('_ganti_password_form',['model'=>$modelPassword])?>

                                </div>
                                <!-- end /.information_wrapper -->
                            </div>
                            <!-- end /.information__set -->
                        </div>
                        <!-- end /.information_module -->
                        <div class="information_module">
                            <a class="toggle_title" href="#collapse-alamat" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                <h4>Alamat
                                    <span class="lnr lnr-chevron-down"></span>
                                </h4>
                            </a>

                            <div class="information__set toggle_module collapse" id="collapse-alamat">
                                <div class="information_wrapper form--fields">

                                    <?=$this->render('_alamat_form',['model'=>$modelAlamat])?>

                                </div>
                                <!-- end /.information_wrapper -->
                            </div>
                            <!-- end /.information__set -->
                        </div>
                        <!-- end /.information_module -->
                    </div>
                    <!-- end /.col-md-6 -->

                    <div class="col-lg-6">
                        <div class="information_module">
                            <a class="toggle_title" href="#collapse3" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                <h4>Foto Profil
                                    <span class="lnr lnr-chevron-down"></span>
                                </h4>
                            </a>

                            <div class="information__set profile_images toggle_module collapse" id="collapse3">
                                <div class="information_wrapper">
                                    <div class="profile_image_area">
                                       <?=$this->render('_fotoprofil_form',['model'=>$modelProfil])?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end /.information_module -->

                        <div class="information_module">
                            <a class="toggle_title" href="#collapse5" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                <h4>Verifikasi Nomor Hp
                                    <span class="lnr lnr-chevron-down"></span>
                                </h4>
                            </a>

                            <div class="information__set social_profile toggle_module collapse " id="collapse5">
                                <div class="information_wrapper">
                                   <?=$this->render('_verifikasi_nomor_hp_form',['model'=>$modelHp])?>
                                </div>
                                <!-- end /.information_wrapper -->
                            </div>
                            <!-- end /.social_profile -->
                        </div>
                        <!-- end /.information_module -->

                        <div class="information_module">
                            <a class="toggle_title" href="#collapse4" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                <h4>Verifikasi Identitas
                                    <span class="lnr lnr-chevron-down"></span>
                                </h4>
                            </a>

                            <div class="information__set mail_setting toggle_module collapse" id="collapse4">
                                <div class="information_wrapper">

                                   <?=$this->render('_verifikasi_form',['model'=>$modelVerifikasi,
                                       'verifikasiSekarang'=>$verifikasiSekarang])?>
                                </div>
                                <!-- end /.information_wrapper -->
                            </div>
                            <!-- end /.information_module -->
                        </div>
                        <!-- end /.information_module -->
                    </div>
                    <!-- end /.col-md-6 -->
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->

        </div>
        <!-- end /.container -->
    </div>
    <!-- end /.dashboard_menu_area -->
</section>
<!--================================
        END DASHBOARD AREA
=================================-->
