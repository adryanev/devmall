<?php

use mdm\admin\Module;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-admin',
    'name' => 'Devmall Admin',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'admin\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => Module::class,
            'layout' => 'left-menu'
        ],
        'datecontrol' => [
            'class' => 'kartik\datecontrol\Module',
            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                kartik\datecontrol\Module::FORMAT_DATE => 'dd MMMM yyyy',
                kartik\datecontrol\Module::FORMAT_TIME => 'HH:mm:ss',
                kartik\datecontrol\Module::FORMAT_DATETIME => 'dd MMMM yyyy HH:mm:ss',
            ],
            'saveTimezone' => 'Asia/Jakarta',
            'displayTimezone' => 'Asia/Jakarta',
            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                kartik\datecontrol\Module::FORMAT_DATE => 'php:U', // saves as unix timestamp
                kartik\datecontrol\Module::FORMAT_TIME => 'php:U',
                kartik\datecontrol\Module::FORMAT_DATETIME => 'php:U',
            ],


            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,

        ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-admin',
        ],
        'user' => [
            'class' => 'common\components\User',
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-admin', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the admin
            'name' => 'devmall-admin',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => [
                //                ['class' => 'common\helpers\UrlRule', 'connectionID' => 'db', /* ... */],
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',

            ],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap4\BootstrapAsset' => [
                    'sourcePath' => '@common/assets/metronic/assets',

                    'css' => ['css/demo1/style.bundle.css']
                ],
                'dosamigos\google\maps\MapAsset' => [
                    'options' => [
                        'key' => $params['maps_api'],
                        'language' => 'id',
                        'version' => '3.1.18'
                    ]
                ],
            ]
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/login',
            'site/error',
            'site/logout',
            //            'admin/*',
            //            'debug/*',
            //            'sertifikat/*',
            //            'sertifikat-institusi/*',
            //            'sertifikat/*',
            //            'sertifikat-prodi/*'
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],
    'params' => $params,
];
