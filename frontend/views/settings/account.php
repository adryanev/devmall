<?php
/* @var $this yii\web\View */
/* @var $modelInformasi InformasiPribadiForm */
/* @var $modelPassword GantiPasswordForm */

$this->title = 'Akun';
$this->params['breadcrumbs'][] = 'Pengaturan';
$this->params['breadcrumbs'][] = $this->title;

use frontend\models\forms\setting\GantiPasswordForm;
use frontend\models\forms\setting\InformasiPribadiForm; ?>
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
                        <!-- end /.information_module -->
                    </div>
                    <!-- end /.col-md-6 -->

                    <div class="col-lg-6">
                        <div class="information_module">
                            <a class="toggle_title" href="#collapse3" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                <h4>Profile Image & Cover
                                    <span class="lnr lnr-chevron-down"></span>
                                </h4>
                            </a>

                            <div class="information__set profile_images toggle_module collapse" id="collapse3">
                                <div class="information_wrapper">
                                    <div class="profile_image_area">
                                        <img src="images/authplc.png" alt="Author profile area">
                                        <div class="img_info">
                                            <p class="bold">Profile Image</p>
                                            <p class="subtitle">JPG, GIF or PNG 100x100 px</p>
                                        </div>

                                        <label for="cover_photo" class="upload_btn">
                                            <input type="file" id="cover_photo">
                                            <span class="btn btn--sm btn--round" aria-hidden="true">Upload Image</span>
                                        </label>
                                    </div>

                                    <div class="prof_img_upload">
                                        <p class="bold">Cover Image</p>
                                        <img src="images/cvrplc.jpg" alt="The great warrior of China">

                                        <div class="upload_title">
                                            <p>JPG, GIF or PNG 750x370 px</p>
                                            <label for="dp" class="upload_btn">
                                                <input type="file" id="dp">
                                                <span class="btn btn--sm btn--round" aria-hidden="true">Upload Image</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end /.information_module -->

                        <div class="information_module">
                            <a class="toggle_title" href="#collapse5" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                <h4>Social Profiles
                                    <span class="lnr lnr-chevron-down"></span>
                                </h4>
                            </a>

                            <div class="information__set social_profile toggle_module collapse " id="collapse5">
                                <div class="information_wrapper">
                                    <div class="social__single">
                                        <div class="social_icon">
                                            <span class="fa fa-facebook"></span>
                                        </div>

                                        <div class="link_field">
                                            <input type="text" class="text_field" placeholder="ex: www.facebook.com/aazztech">
                                        </div>
                                    </div>
                                    <!-- end /.social__single -->

                                    <div class="social__single">
                                        <div class="social_icon">
                                            <span class="fa fa-twitter"></span>
                                        </div>

                                        <div class="link_field">
                                            <input type="text" class="text_field" placeholder="ex: www.twitter.com/aazztech">
                                        </div>
                                    </div>
                                    <!-- end /.social__single -->

                                    <div class="social__single">
                                        <div class="social_icon">
                                            <span class="fa fa-google-plus"></span>
                                        </div>

                                        <div class="link_field">
                                            <input type="text" class="text_field" placeholder="ex: www.google.com/aazztech">
                                        </div>
                                    </div>
                                    <!-- end /.social__single -->

                                    <div class="social__single">
                                        <div class="social_icon">
                                            <span class="fa fa-behance"></span>
                                        </div>

                                        <div class="link_field">
                                            <input type="text" class="text_field" placeholder="ex: www.behance.com/aazztech">
                                        </div>
                                    </div>
                                    <!-- end /.social__single -->

                                    <div class="social__single">
                                        <div class="social_icon">
                                            <span class="fa fa-dribbble"></span>
                                        </div>

                                        <div class="link_field">
                                            <input type="text" class="text_field" placeholder="ex: www.dribbble.com/aazztech">
                                        </div>
                                    </div>
                                    <!-- end /.social__single -->
                                </div>
                                <!-- end /.information_wrapper -->
                            </div>
                            <!-- end /.social_profile -->
                        </div>
                        <!-- end /.information_module -->

                        <div class="information_module">
                            <a class="toggle_title" href="#collapse4" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                <h4>Email Settings
                                    <span class="lnr lnr-chevron-down"></span>
                                </h4>
                            </a>

                            <div class="information__set mail_setting toggle_module collapse" id="collapse4">
                                <div class="information_wrapper">
                                    <div class="custom_checkbox">
                                        <input type="checkbox" id="opt1" class="" name="mail_rating_reminder" checked>
                                        <label for="opt1">
                                            <span class="shadow_checkbox"></span>
                                            <span class="radio_title">Rating Reminders</span>
                                            <span class="desc">Send an email reminding me to rate an item after purchase</span>
                                        </label>
                                    </div>
                                    <!-- end /.custom-radio -->

                                    <div class="custom_checkbox">
                                        <input type="checkbox" id="opt2" class="" name="mail_update_noti" checked>
                                        <label for="opt2">
                                            <span class="shadow_checkbox"></span>
                                            <span class="radio_title">Item Update Notifications</span>
                                            <span class="desc">Send an email when an item I've purchased is updated</span>
                                        </label>
                                    </div>
                                    <!-- end /.custom_checkbox -->

                                    <div class="custom_checkbox">
                                        <input type="checkbox" id="opt3" class="" name="mail_comment_noti" checked>
                                        <label for="opt3">
                                            <span class="shadow_checkbox"></span>
                                            <span class="radio_title">Item Comment Notifications</span>
                                            <span class="desc">Send me an email when someone comments on one of my items</span>
                                        </label>
                                    </div>
                                    <!-- end /.custom_checkbox -->

                                    <div class="custom_checkbox">
                                        <input type="checkbox" id="opt4" class="" name="mail_item_review_noti" checked>
                                        <label for="opt4">
                                            <span class="shadow_checkbox"></span>
                                            <span class="radio_title">Item Review Notifications</span>
                                            <span class="desc">Send me an email when my items are approved or rejected</span>
                                        </label>
                                    </div>
                                    <!-- end /.custom_checkbox -->

                                    <div class="custom_checkbox">
                                        <input type="checkbox" id="opt5" class="" name="mail_review_noti" checked>
                                        <label for="opt5">
                                            <span class="shadow_checkbox"></span>
                                            <span class="radio_title">Buyer Review Notifications</span>
                                            <span class="desc">Send me an email when someone leaves a review with their rating</span>
                                        </label>
                                    </div>
                                    <!-- end /.custom_checkbox -->

                                    <div class="custom_checkbox">
                                        <input type="checkbox" id="opt6" class="" name="mail_support_noti" checked>
                                        <label for="opt6">
                                            <span class="shadow_checkbox"></span>
                                            <span class="radio_title">Support Notifications</span>
                                            <span class="desc">Send me emails showing my soon to expire support entitlements</span>
                                        </label>
                                    </div>
                                    <!-- end /.custom_checkbox -->

                                    <div class="custom_checkbox">
                                        <input type="checkbox" id="opt7" class="" name="mail_weekly">
                                        <label for="opt7">
                                            <span class="shadow_checkbox"></span>
                                            <span class="radio_title">Weekly Summary Emails</span>
                                            <span class="desc">Send me emails showing my soon to expire support entitlements</span>
                                        </label>
                                    </div>
                                    <!-- end /.custom_checkbox -->

                                    <div class="custom_checkbox">
                                        <input type="checkbox" id="opt8" class="" name="mail_newsletter">
                                        <label for="opt8">
                                            <span class="shadow_checkbox"></span>
                                            <span class="radio_title">MartPlace Newsletter</span>
                                            <span class="desc">Get update about latest news, update and more.</span>
                                        </label>
                                    </div>
                                    <!-- end /.custom_checkbox -->
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
