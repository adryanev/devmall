<?php

use yii\bootstrap4\Html;

$namaLengkap = Html::encode(Yii::$app->user->identity->profilUser->getNamaLengkap());
$inisial = strtoupper(substr(Html::encode($namaLengkap), 0, 1));
$booth = Yii::$app->user->identity->booth;
?>
    <!-- begin:: Header -->
    <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

        <!-- begin:: Aside -->
        <div class="kt-header__brand kt-grid__item  " id="kt_header_brand">
            <div class="kt-header__brand-logo">
                <a href="demo6/index.html">
                    <?= Html::img('@web/media/logos/logo-6.png') ?>
                </a>
            </div>
        </div>

        <!-- end:: Aside -->


        <!-- begin:: Header Topbar -->
        <div class="kt-header__topbar">
<?php
                $query= (new \yii\db\Query())
                        ->select("*, notifikasi.id AS idNotif")
                        ->from("notifikasi")
                        ->leftJoin("user", "user.id = notifikasi.receiver")
                        ->where("notifikasi.status= 'Belum Dibaca' AND notifikasi.receiver=". Yii::$app->user->identity->id)
                        ->all();

                $notif = $query;

 ?>

            <!--begin: Notifications -->
            <div class="kt-header__topbar-item dropdown">
                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                    <span class="kt-header__topbar-icon kt-header__topbar-icon--success"><i
                                class="flaticon2-bell-alarm-symbol"></i><b><sup><?= count($notif) ?></sup> </b></span>

                    <span class="kt-hidden kt-badge kt-badge--danger"></span>
                </div>
                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                    <form>
                        <!--begin: Head -->
                        <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b"
                             style="background-image: url(<?= Yii::getAlias('@web/media/misc/bg-1.jpg') ?>)">

                            <h3 class="kt-head__title">
                                User Notifications
                                &nbsp;
                                <span class="btn btn-success btn-sm btn-bold btn-font-md"> <?=  count($notif) ?> UnRead</span>
                            </h3>
                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-success kt-notification-item-padding-x"
                                role="tablist">
                                <li class="nav-item">
                                </li>

                            </ul>
                        </div>

                        <!--end: Head -->
                        <div class="tab-content">
                            <div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
                                <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
<?php
    foreach ($notif as $v) {


                        echo Html::a("<div class=\"kt-notification__item-icon\">
                                        <i class=\"flaticon2-box-1 kt-font-brand\"></i>
                                    </div>
                                    <div class=\"kt-notification__item-details\">
                                        <div class=\"kt-notification__item-title\">
                                            ". $v['context'] ."
                                        </div>
                                        <div class=\"kt-notification__item-time\">

                                        </div>
                                    </div>", ['/notifikasi/view/'.$v['idNotif']], ['class' => 'kt-notification__item']);

    }
 ?>
                                <a href="http://localhost/devmall/penjual/web/notifikasi/index" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-box-1 kt-font-brand"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            Semua Notifikasi
                                        </div>
                                        <div class="kt-notification__item-time">

                                        </div>
                                    </div>
                                </a>

                            </div>
                            </div>
                            <div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
                                <div class="kt-grid kt-grid--ver" style="min-height: 200px;">
                                    <div class="kt-grid kt-grid--hor kt-grid__item kt-grid__item--fluid kt-grid__item--middle">
                                        <div class="kt-grid__item kt-grid__item--middle kt-align-center">
                                            All caught up!
                                            <br>No new notifications.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!--end: Notifications -->

            <!--begin: User bar -->
            <div class="kt-header__topbar-item kt-header__topbar-item--user">
                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                    <span class="kt-hidden kt-header__topbar-welcome">Hi,</span>
                    <span class="kt-hidden kt-header__topbar-username">Nick</span>
                    <img class="kt-hidden" alt="Pic" src="./assets/media/users/300_21.jpg"/>
                    <span class="kt-header__topbar-icon kt-hidden-"><i class="flaticon2-user-outline-symbol"></i></span>
                </div>
                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                    <!--begin: Head -->
                    <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x"
                         style="background-image: url(<?= Yii::getAlias('@web/media/misc/bg-1.jpg') ?>)">
                        <div class="kt-user-card__avatar">
                            <!--                        <img class="kt-hidden" alt="Pic" src="./assets/media/users/300_25.jpg" />-->

                            <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                            <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success"><?= $inisial ?></span>
                        </div>
                        <div class="kt-user-card__name">
                            <?= $namaLengkap ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?= Html::a("
<span class='text-white'>
                            <i class=\"flaticon-coins\"></i>
                       ".Yii::$app->formatter->asCurrency($booth->coin->saldo).'</span>', ['/coin/index']) ?>
                                </div>

                            </div>

                        </div>

                    </div>

                    <!--end: Head -->

                    <!--begin: Navigation -->
                    <div class="kt-notification">
                        <?= Html::a("<div class=\"kt-notification__item-icon\">
                            <i class=\"flaticon2-calendar-3 kt-font-success\"></i>
                        </div>
                        <div class=\"kt-notification__item-details\">
                            <div class=\"kt-notification__item-title kt-font-bold\">
                                Profil Saya
                            </div>
                            <div class=\"kt-notification__item-time\">
                                Pengaturan akun dan lainnya
                            </div>
                        </div>", ['/profile/index'], ['class' => 'kt-notification__item']) ?>


                        <div class="kt-notification__custom kt-space-between">
                            <?= \yii\bootstrap4\Html::a('Keluar', ['/site/logout'], ['class' => 'btn btn-label btn-label-brand btn-sm btn-bold', 'data' => ['method' => 'post', 'confirm' => 'Apakah anda ingin keluar?']]) ?>
                        </div>
                    </div>
                    <!--end: Navigation -->
                </div>
            </div>

            <!--end: User bar -->
        </div>

        <!-- end:: Header Topbar -->
    </div>

    <!-- end:: Header -->

<?php
//$jsTime = <<<JS
//var timeDisplay = document.getElementById("time");
//
//
//function refreshTime() {
//    moment.locale('ID');
//  var dateString = moment().format('dddd, D MMMM YYYY, hh:mm:ss');
//  timeDisplay.innerHTML = dateString;
//}
//
//setInterval(refreshTime, 1000);
//JS;
//$this->registerJs($jsTime,\yii\web\View::POS_LOAD);
//
//?>
