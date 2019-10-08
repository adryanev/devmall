<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Asia/Jakarta',

    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager'=>[
            'class'=>\yii\rbac\PhpManager::class,
            'itemFile' => '@common/auth/rbac/items.php',
            'assignmentFile' => '@common/auth/rbac/assignments.php',
            'ruleFile' => '@common/auth/rbac/rules.php',
        ]
    ],
];
