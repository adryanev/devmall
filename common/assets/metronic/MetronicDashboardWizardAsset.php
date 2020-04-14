<?php


namespace common\assets\metronic;


use yii\web\AssetBundle;

class MetronicDashboardWizardAsset extends AssetBundle
{

    public $sourcePath = '@common/assets/metronic/assets';


    public $depends = [MetronicDashboardDemo6Asset::class];
    public $css = ['css/demo6/pages/general/wizard/wizard-1.css'];
    public $js = ['js/demo6/pages/wizard/wizard-1.js'];

}