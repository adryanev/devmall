<?php
/**
 * @var $this yii\web\View
 * @var $user common\models\User
 * @var $keranjangDataProvider yii\data\ActiveDataProvider
 */
$profilUser = $user->profilUser;
$this->title = 'Pembayaran';

use common\models\Keranjang;
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper; ?>

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
               <?= Html::textInput('nama_depan',$profilUser->nama_depan,['readonly'=>true,'class'=>'text_field'])?>
           </div>
          </div>

          <div class="col-md-6">
           <div class="form-group">
            <label for="last_name">Nama Belakang
            </label>
               <?= Html::textInput('nama_belakang',$profilUser->nama_belakang,['readonly'=>true,'class'=>'text_field'])?>
           </div>
          </div>
         </div>
         <!-- end /.row -->

         <div class="form-group">
          <label for="email1">Email
           <sup>*</sup>
          </label>
             <?= Html::textInput('email_user',$user->email,['readonly'=>true,'class'=>'text_field'])?>


         <div class="form-group">
          <label for="address1">Nomor Hp</label>
             <?= Html::textInput('nomor_hp_user',$user->nomor_hp,['readonly'=>true,'class'=>'text_field'])?>
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
           $total = 0;
           foreach ($keranjangDataProvider->models as /** @var $model Keranjang */$model) :?>
        <li class="item">
            <?=Html::a($model->produk->nama,['produk/view','id'=>$model->produk->id],['target'=>'_blank'])?>
         <span><?=Yii::$app->formatter->asCurrency($model->produk->harga)?></span>
        </li>

           <?php
           $total+=$model->produk->harga;
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
        <h4>Select Payment Method</h4>
       </div>

       <ul>
        <li>
         <div class="custom-radio">
          <input type="radio" id="opt1" class="" name="filter_opt">
          <label for="opt1">
           <span class="circle"></span>Credit Card</label>
         </div>
         <img src="images/cards.png" alt="Visa Cards">
        </li>

        <li>
         <div class="custom-radio">
          <input type="radio" id="opt2" class="" name="filter_opt">
          <label for="opt2">
           <span class="circle"></span>Paypal</label>
         </div>
         <img src="images/paypal.png" alt="Visa Cards">
        </li>

        <li>
         <div class="custom-radio">
          <input type="radio" id="opt3" class="" name="filter_opt">
          <label for="opt3">
           <span class="circle"></span>Martplace Credit</label>
         </div>
         <p>Balance
          <span class="bold">$180</span>
         </p>
        </li>
       </ul>

       <div class="payment_info modules__content">
        <div class="form-group">
         <label for="card_number">Card Number</label>
         <input id="card_number" type="text" class="text_field" placeholder="Enter your card number here...">
        </div>

        <!-- lebel for date selection -->
        <label for="name">Expire Date</label>
        <div class="row">
         <div class="col-md-6 col-sm-6">
          <div class="form-group">
           <div class="select-wrap select-wrap2">
            <select name="months" id="name">
             <option value="">Month</option>
             <option value="jan">jan</option>
             <option value="feb">Feb</option>
             <option value="mar">Mar</option>
             <option value="apr">Apr</option>
             <option value="may">May</option>
             <option value="jun">Jun</option>
             <option value="jul">Jul</option>
             <option value="aug">Aug</option>
             <option value="sep">Sep</option>
             <option value="oct">Oct</option>
             <option value="nov">Nov</option>
             <option value="dec">Dec</option>
            </select>
            <span class="lnr lnr-chevron-down"></span>
           </div>
           <!-- end /.select-wrap -->
          </div>
          <!-- end /.form-group -->
         </div>
         <!-- end /.col-md-6-->

         <div class="col-md-6 col-sm-6">
          <div class="form-group">
           <div class="select-wrap select-wrap2">
            <select name="years" id="years">
             <option value="">Year</option>
             <option value="28">2028</option>
             <option value="27">2027</option>
             <option value="26">2026</option>
             <option value="25">2025</option>
             <option value="24">2024</option>
             <option value="23">2023</option>
             <option value="22">2022</option>
             <option value="21">2021</option>
             <option value="20">2020</option>
             <option value="19">2019</option>
             <option value="18">2019</option>
             <option value="17">2019</option>
            </select>
            <span class="lnr lnr-chevron-down"></span>
           </div>
           <!-- end /.select-wrap -->
          </div>
          <!-- end /.form-group -->
         </div>
         <!-- end /.col-md-6-->
        </div>
        <!-- end /.row -->

        <div class="row">
         <div class="col-md-6">
          <div class="form-group">
           <label for="cv_code">CVV Code</label>
           <input id="cv_code" type="text" class="text_field" placeholder="Enter code here...">
          </div>

          <button type="submit" class="btn btn--round btn--default">Confirm Order</button>
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
