<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','autocomplete'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
          ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'autocomplete' => [
            'class' => 'iiifx\Yii2\Autocomplete\Component',
            'config' => [
                '@common/config/main.php', # <-- config list
                '@common/config/main-local.php',
                '@console/config/main.php',
                '@console/config/main-local.php',
                '@admin/config/main.php',
                '@admin/config/main-local.php',
                '@penjual/config/main.php',
                '@penjual/config/main-local.php',
                '@frontend/config/main.php',
                '@frontend/config/main-local.php',
            ],
        ],

    ],
    'params' => $params,
];
