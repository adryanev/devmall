<?php
/**
 * @var $this yii\web\View
 * @var $user common\models\User
 * @var $keranjangDataProvider yii\data\ActiveDataProvider
 */
$profilUser = $user->profilUser;
$this->title = 'Pembayaran';
$total = 0;

use common\models\Keranjang;
use yii\bootstrap4\Html;
use yii\helpers\Json;
use yii\helpers\Url;

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
                                                <?= Html::textInput('nama_depan', $profilUser->nama_depan, ['readonly' => true, 'class' => 'text_field']) ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="last_name">Nama Belakang
                                                </label>
                                                <?= Html::textInput('nama_belakang', $profilUser->nama_belakang, ['readonly' => true, 'class' => 'text_field']) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end /.row -->

                                    <div class="form-group">
                                        <label for="email1">Email
                                            <sup>*</sup>
                                        </label>
                                        <?= Html::textInput('email_user', $user->email, ['readonly' => true, 'class' => 'text_field']) ?>


                                        <div class="form-group">
                                            <label for="address1">Nomor Hp</label>
                                            <?= Html::textInput('nomor_hp_user', $user->nomor_hp, ['readonly' => true, 'class' => 'text_field']) ?>
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
                                <h4>Produk dibeli</h4>
                            </div>

                            <ul>
                                <?php

                                foreach ($keranjangDataProvider->models as /** @var $model Keranjang */
                                         $model) :?>
                                    <li class="item">
                                        <?= Html::a($model->produk->nama, ['produk/view', 'id' => $model->produk->id], ['target' => '_blank']) ?>
                                        <span><?= Yii::$app->formatter->asCurrency($model->produk->harga) ?></span>
                                    </li>

                                    <?php
                                    $total += $model->produk->harga;
                                endforeach; ?>
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
                                    <div class="form-group">
                                        <div class="custom_checkbox">
                                            <?= Html::checkbox('cicilan', false, ['id' => 'cicilan-checkbox']) ?>
                                            <label for="cicilan-checkbox">
                                                <span class="shadow_checkbox"></span>
                                                <span class="label_text">Cicilan</span>
                                            </label>

                                        </div>

                                    </div>
                                    <ul class="cicilan-list d-none">
                                        <li>
                                            <div class="custom-radio">
                                                <?= Html::radio('jumlah_cicilan', false, ['id' => 'opt1', 'value' => 3]) ?>
                                                <label for="opt1">
                                                    <span class="circle"></span>3 Bulan</label>
                                            </div>
                                            <p><?= '(3x ' . Yii::$app->formatter->asCurrency(round($total / 3)) . ')' ?></p>
                                        </li>

                                        <li>
                                            <div class="custom-radio">
                                                <?= Html::radio('jumlah_cicilan', false, ['id' => 'opt2', 'value' => 6]) ?>
                                                <label for="opt2">
                                                    <span class="circle"></span>6 Bulan</label>
                                            </div>
                                            <p><?= '(6x ' . Yii::$app->formatter->asCurrency(round($total / 6)) . ')' ?></p>
                                        </li>

                                        <li>
                                            <div class="custom-radio">
                                                <?= Html::radio('jumlah_cicilan', false, ['id' => 'opt3', 'value' => 9]) ?>
                                                <label for="opt3">
                                                    <span class="circle"></span>9 Bulan</label>
                                            </div>
                                            <p><?= '(9x ' . Yii::$app->formatter->asCurrency(round($total / 9)) . ')' ?></p>
                                        </li>

                                        <li>
                                            <div class="custom-radio">
                                                <?= Html::radio('jumlah_cicilan', false, ['id' => 'opt4', 'value' => 12]) ?>
                                                <label for="opt4">
                                                    <span class="circle"></span>12 Bulan</label>
                                            </div>
                                            <p><?= '(12x ' . Yii::$app->formatter->asCurrency(round($total / 12)) . ')' ?></p>
                                        </li>
                                    </ul>
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

\common\assets\MidtransAsset::register($this);

$datakeranjang = Json::encode($keranjangDataProvider->models);
$url = Url::to(['pembayaran/confirm-order']);
$user = Json::encode(Yii::$app->user->identity);
$js = <<<JS
var cicil = 0;
var cicilan = 0;
var dataProduk = {keranjang:$datakeranjang,total:$total,user:$user,isCicilan: cicil,jumlahCicilan:cicilan};

$('#cicilan-checkbox').on('change',function() {
    var checked = $('#cicilan-checkbox').prop('checked');
    if(checked){
        dataProduk.isCicilan = true;
       $('.cicilan-list').removeClass('d-none');
       console.log(dataProduk);
    }
    else{
        dataProduk.isCicilan = false;
        dataProduk.jumlahCicilan = 1;
        $('.cicilan-list').addClass('d-none');
        console.log(dataProduk);
    }
});
$('input[name=jumlah_cicilan]').on('change',function() {
    dataProduk.jumlahCicilan = $('input[name=jumlah_cicilan]:checked').val();
    console.log(dataProduk);
});
$('#button-bayar').on('click',function() {
  console.log("bayar function triggered");
  console.log(dataProduk);
     $.post(
        "$url",{data: dataProduk},
        function(data, status) {
            snap.pay(data.snap_token,{
                onSuccess: function(result){
                   console.log(result);
                },
                onPending: function(result) {
                    console.log(result);
                },
                onError: function(result) {
                    console.log(result);
                }
            });
        }     
    );
});
JS;

$this->registerJs($js);
