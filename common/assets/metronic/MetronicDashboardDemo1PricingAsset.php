<?php


namespace common\assets\metronic;


use yii\web\AssetBundle;

class MetronicDashboardDemo1PricingAsset extends AssetBundle
{

    public $sourcePath = '@common/assets/metronic/assets';


    public $depends = [MetronicDashboardDemo1Asset::class];
    public $css = ['css/demo1/pages/general/pricing/pricing-1.css'];

}