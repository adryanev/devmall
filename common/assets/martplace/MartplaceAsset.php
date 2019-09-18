<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 17/09/19
 * Time: 14.51
 */

namespace common\assets\martplace;


use dosamigos\chartjs\ChartJsAsset;
use yii\bootstrap4\BootstrapAsset;
use yii\bootstrap4\BootstrapPluginAsset;
use yii\jui\JuiAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

class MartplaceAsset extends AssetBundle
{

    public $sourcePath = '@common/assets/martplace/assets';

    public $css = [
        'css/animate.css',
        'css/fontello.css',
        'css/lnr-icon.css',
        'css/owl.carousel.css',
       'https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css',
        'css/slick.css',
        'css/trumbowyg.min.css',
        'css/style.css'
    ];

    public $js = [
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyA0C5etf1GVmL_ldVAichWwFFVcDfa1y_c',
        'js/vendor/jquery/popper.min.js',
        'js/vendor/jquery/uikit.min.js',
        'js/vendor/grid.min.js',
        'js/vendor/jquery.barrating.min.js',
        'js/vendor/jquery.countdown.min.js',
        'js/vendor/jquery.counterup.min.js',
        'js/vendor/jquery.easing1.3.js',
        'js/vendor/owl.carousel.min.js',
        'js/vendor/slick.min.js',
        'js/vendor/tether.min.js',
        'js/vendor/trumbowyg.min.js',
        'js/vendor/waypoints.min.js',
        'js/dashboard.js',
        'js/main.js',
        'js/map.js'

    ];

    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        BootstrapPluginAsset::class,
        JuiAsset::class,
        ChartJsAsset::class
    ];
}