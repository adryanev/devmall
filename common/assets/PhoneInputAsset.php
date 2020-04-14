<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 10/4/2019
 * Time: 8:17 PM
 */
namespace  common\assets;

use yii\web\AssetBundle;

class PhoneInputAsset extends AssetBundle
{
    /** @var string */
    public $sourcePath = '@bower/intl-tel-input';
    /** @var array */
    public $css = ['build/css/intlTelInput.css'];
    /** @var array */
    public $js = [
        'build/js/utils.js',
        'build/js/intlTelInput.min.js',
        'build/js/intTelInput-jquery.js'
    ];
    /** @var array */
    public $depends = ['yii\web\JqueryAsset'];
}