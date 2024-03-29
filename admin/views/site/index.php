<?php

/* @var $this yii\web\View */
/* @var $jumlahPengguna int */
/* @var $jumlahBooth int */
/* @var $jumlahProduk int */
/* @var $jumlahTransaksi */


$this->title = 'Beranda';
$this->params['breadcrumbs'][] = $this->title;

?>
<!--Begin::Section-->
<div class="kt-portlet">
    <div class="kt-portlet__body  kt-portlet__body--fit">
        <div class="row row-no-padding row-col-separator-xl">
            <div class="col-md-12 col-lg-6 col-xl-3">

                <!--begin::Total Profit-->
                <div class="kt-widget24">
                    <div class="kt-widget24__details">
                        <div class="kt-widget24__info">
                            <h4 class="kt-widget24__title">
                                Penjual
                            </h4>
                            <span class="kt-widget24__desc">Jumlah Penjual</span>
                        </div>
                        <span class="kt-widget24__stats kt-font-brand">
                            <span class="counter"><?=$jumlahBooth?></span>
                        </span>
                    </div>
                </div>

                <!--end::Total Profit-->
            </div>
            <div class="col-md-12 col-lg-6 col-xl-3">

                <!--begin::New Feedbacks-->
                <div class="kt-widget24">
                    <div class="kt-widget24__details">
                        <div class="kt-widget24__info">
                            <h4 class="kt-widget24__title">
                                Pengguna
                            </h4>
                            <span class="kt-widget24__desc">Jumlah Akun Pengguna</span>
                        </div>
                        <span class="kt-widget24__stats kt-font-warning"><span class="counter"><?=$jumlahPengguna?></span></span>
                    </div>
                </div>

                <!--end::New Feedbacks-->
            </div>
            <div class="col-md-12 col-lg-6 col-xl-3">

                <!--begin::New Orders-->
                <div class="kt-widget24">
                    <div class="kt-widget24__details">
                        <div class="kt-widget24__info">
                            <h4 class="kt-widget24__title">Produk</h4>
                            <span class="kt-widget24__desc">Jumlah Produk</span>
                        </div>
                        <span class="kt-widget24__stats kt-font-danger"><span class="counter"><?=$jumlahProduk?></span></span>
                    </div>

                </div>

                <!--end::New Orders-->
            </div>
            <div class="col-md-12 col-lg-6 col-xl-3">

                <!--begin::New Users-->
                <div class="kt-widget24">
                    <div class="kt-widget24__details">
                        <div class="kt-widget24__info">
                            <h4 class="kt-widget24__title">
                                Transaksi
                            </h4>
                            <span class="kt-widget24__desc">Jumlah Transaksi</span>
                        </div>
                        <span class="kt-widget24__stats kt-font-success"><span class="counter"><?=$jumlahTransaksi?></span></span>
                    </div>
                </div>

                <!--end::New Users-->
            </div>
        </div>
    </div>
</div>



