<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Asia/Jakarta',
    'language' => 'id-ID',
    'sourceLanguage' => 'en',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'locale' => 'id-ID',
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',

        ],
        'authManager' => [
            'class' => \yii\rbac\PhpManager::class,
            'itemFile' => '@common/auth/rbac/items.php',
            'assignmentFile' => '@common/auth/rbac/assignments.php',
            'ruleFile' => '@common/auth/rbac/rules.php',
        ],
        'BitckoMailer'=>[
            'class'=>'bitcko\mailer\BitckoMailer',
            'SMTPDebug'=> 0, // 0 to disable, optional
            'isSMTP'=>true, // default true
            'Host'=>'smtp.gmail.com', //optional
            'SMTPAuth'=>true, //optional
            'Username'=>'petya.orlov14@gmail.com', //optional
            'Password'=>'Qwerty21+', //optional
            'SMTPSecure'=>'tls', //optional, tls or ssl
            'Port'=>587, //optional, smtp server port
            'isHTML'=>true, // default true
        ],
        'cart' => [
            'class' => 'common\components\shoppingcart\ShoppingCart',
            'storage' => [
                'class'=>\common\components\shoppingcart\storages\DatabaseStorage::class,
            ]
        ],
        'i18n' => [
            'translations' => [
                'notification' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/components/notifications/messages',
                    'fileMap' => [
                        'notification' => 'notification.php',
                    ],
                ],
            ],
        ],
    ],
];
