<?php


namespace common\assets;


use common\assets\martplace\MartplaceAsset;
use yii\web\AssetBundle;

class MidtransAsset extends AssetBundle
{

    public $js = ['https://app.sandbox.midtrans.com/snap/snap.js'];
    public $depends = [MartplaceAsset::class];

    public function init()
    {
        $this->jsOptions['data-client-key'] = \Yii::$app->params['midtrans_client_key'];
        parent::init();
    }
}