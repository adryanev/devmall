<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 9/4/2019
 * Time: 8:41 PM
 */

namespace frontend\assets;


use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;
use yii\web\YiiAsset;

class FrontendAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/font-awesome.css',
        'css/ionicons.min.css',
        'css/slick.css',
        'css/slick-theme.css',
        'css/owl.carousel.min.css',
        'css/style.css',
        'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800',
        'https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700',
        'https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700'
    ];

    public $js = [
        'js/owl.carousel.min.js',
        'js/slick.min.js',
        'http://maps.googleapis.com/maps/api/js',
        'js/main.js'
    ];



    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
    ];
}