<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 10/09/19
 * Time: 21.21
 */

use yii\bootstrap\Html; ?>

<section class="slide">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="row top-row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="single-item js-banner">
                            <div class="slide-img">
                                <?=Html::img('@web/img/slider/image-slider1.jpg',['class'=>'img-responsive'])?>
                                <div class="slide-content">
                                    <h5 class="brand">Sony ALPHA</h5>
                                    <h3><span class="strong">Perfection</span><br>for all</h3>
                                    <p>Dolor sit amet, consecte, adipiscing.</p>
                                </div>
                                <a href="#" class="slide-button">shop now</a>
                            </div>
                            <div class="slide-img">
                                <?=Html::img('@web/img/slider/image-slider2.jpg',['class'=>'img-responsive'])?>
                                <div class="slide-content ver2">
                                    <h5 class="brand">Sony ALPHA</h5>
                                    <h3><span class="strong">Perfection</span><br>for all</h3>
                                    <p>Dolor sit amet, consecte, adipiscing.</p>
                                </div>
                                <a href="#" class="slide-button">shop now</a>
                            </div>
                            <div class="slide-img">
                                <?=Html::img('@web/img/slider/image-slider3.jpg',['class'=>'img-responsive'])?>
                                <div class="slide-content ver2">
                                    <h5 class="brand">Sony ALPHA</h5>
                                    <h3><span class="strong">Perfection</span><br>for all</h3>
                                    <p>Dolor sit amet, consecte, adipiscing.</p>
                                </div>
                                <a href="#" class="slide-button">shop now</a>
                            </div>
                            <div class="slide-img">
                                <?=Html::img('@web/img/slider/image-slider4.jpg',['class'=>'img-responsive'])?>
                                <div class="slide-content ver2">
                                    <h5 class="brand">Sony ALPHA</h5>
                                    <h3><span class="strong">Perfection</span><br>for all</h3>
                                    <p>Dolor sit amet, consecte, adipiscing.</p>
                                </div>
                                <a href="#" class="slide-button">shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="sub-banner">

                            <a href="#"><?=Html::img('@web/img/banner/banner-2.jpg',['class'=>'img-responsive'])?>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="sub-banner">
                            <a href="#"><?=Html::img('@web/img/banner/banner-3.jpg',['class'=>'img-responsive'])?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-banner"></div>
</section>

