<?php


namespace common\assets\metronic;


use yii\web\AssetBundle;

class MetronicDashboardPricingAsset extends AssetBundle
{

    public $sourcePath = '@common/assets/metronic/assets';


    public $depends = [BaseMetronicAsset::class];
    public $css = ['css/demo1/pages/general/pricing/pricing-1.css'];

}