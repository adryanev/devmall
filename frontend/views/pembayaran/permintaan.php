<?php

/**
 * @var $this yii\web\View
 * @var $riwayat common\models\PembayaranTransaksiPermintaan
 * @var $user common\models\User
 * @var $transaksiPermintaan common\models\TransaksiPermintaan
 */

use common\assets\MidtransAsset;
use yii\bootstrap4\Html;
use yii\helpers\Json;
use yii\helpers\Url;

$this->title = 'Pembayaran Permintaan';
$this->params['breadcrumbs'][] = [
    'label' => 'Permintaan',
    'url' => ['permintaan/view', 'id' => $transaksiPermintaan->id_permintaan]
];
$this->params['breadcrumbs'][] = ['label' => $this->title];

$profilUser = $user->profilUser;
$total = $riwayat->nominal;

?>

    <!--================================
               START DASHBOARD AREA
       =================================-->
    <section class="dashboard-area">
        <div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="information_module">
                            <div class="toggle_title">
                                <h4>Informasi Pembayaran </h4>
                            </div>

                            <div class="information__set">
                                <div class="information_wrapper form--fields">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first_name">Nama Depan
                                                </label>
                                                <?= Html::textInput('nama_depan', $profilUser->nama_depan,
                                                    ['readonly' => true, 'class' => 'text_field']) ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="last_name">Nama Belakang
                                                </label>
                                                <?= Html::textInput('nama_belakang', $profilUser->nama_belakang,
                                                    ['readonly' => true, 'class' => 'text_field']) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end /.row -->

                                    <div class="form-group">
                                        <label for="email1">Email
                                            <sup>*</sup>
                                        </label>
                                        <?= Html::textInput('email_user', $user->email,
                                            ['readonly' => true, 'class' => 'text_field']) ?>


                                        <div class="form-group">
                                            <label for="address1">Nomor Hp</label>
                                            <?= Html::textInput('nomor_hp_user', $user->nomor_hp,
                                                ['readonly' => true, 'class' => 'text_field']) ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end /.information__set -->
                        </div>
                        <!-- end /.information_module -->
                    </div>
                    <!-- end /.col-md-6 -->

                    <div class="col-lg-6">
                        <div class="information_module order_summary">
                            <div class="toggle_title">
                                <h4>Produk dibeli (<?= Html::a($transaksiPermintaan->permintaan->nama,
                                        ['permintaan/view', 'id' => $transaksiPermintaan->id_permintaan],
                                        ['target' => '_blank']) ?> )</h4>

                            </div>

                            <ul>
                                <li class="item">
                                    <?= Html::a('Harga Aplikasi',
                                        '') ?>
                                    <span><?= Yii::$app->formatter->asCurrency($transaksiPermintaan->permintaan->harga) ?></span>
                                </li>
                                <li class="item">
                                    <?= Html::a($riwayat->jenisString, '') ?>
                                    <span><?= Yii::$app->formatter->asCurrency($total) ?></span>
                                </li>


                                <hr>
                                <li class="item">
                                    <a>Total</a>
                                    <span><?= Yii::$app->formatter->asCurrency($total) ?></span>

                                </li>
                            </ul>

                        </div>
                        <!-- end /.information_module-->

                        <div class="information_module payment_options">
                            <div class="toggle_title">
                                <h4>Bayar</h4>
                            </div>


                            <div class="payment_info modules__content">
                                <form action="" class="form">

                                </form>


                                <button type="submit" id="button-bayar" class="btn btn--round btn--default">Konfirmasi
                                    Pembelian
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end /.information_module-->
            </div>
            <!-- end /.col-md-6 -->
        </div>
        <!-- end /.row -->
        <!-- end /form -->
        </div>
        <!-- end /.container -->
        </div>
        <!-- end /.dashboard_menu_area -->
    </section>
    <!--================================
            END DASHBOARD AREA
    =================================-->
<?php

MidtransAsset::register($this);

$url = Url::to(['pembayaran/confirm-permintaan']);
$id = $riwayat->id;
$js = <<<JS
var dataProduk = {id:$id,total:$total}
$('#button-bayar').on('click',function() {
  console.log("bayar function triggered");
  console.log(dataProduk);
     $.post(
        "$url",{data: dataProduk}
    ).done( function(data, status) {
            console.log(data);
            window.location = data.payment_url
            });
        }).error( function(data) {
            console.log(data)
        });
});
JS;

$this->registerJs($js);

