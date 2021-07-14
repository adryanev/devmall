<?php

$ini = parse_ini_file(__DIR__ . '/../../system-configuration.ini');

return [
    'adminEmail' => 'admin@devmall.test',
    'supportEmail' => 'support@devmall.test',
    'senderEmail' => 'noreply@devmall.test',
    'senderName' => 'Devmall mailer',
    'user.passwordResetTokenExpire' => 3600,
    'instansi' => $ini['instansi'],
    'nama_sistem' => $ini['nama_sistem'],
    'url_instansi' => $ini['url_instansi'],
    'author' => $ini['author'],
    'maps_api' => $ini['google_maps'],
    'midtrans_client_key' => $ini['midtrans_client_key'],
    'midtrans_server_key' => $ini['midtrans_server_key'],
    'midtrans_merchant_id' => $ini['midtrans_merchant_id'],
    'bsVersion' => '4.x', // this will set globally `bsVersion` to Bootstrap 4.x for all Krajee Extensions
    'mdm.admin.configs' => [
        'advanced' => [
            'app-admin' => [
                '@common/config/main.php',
                '@common/config/main-local.php',
                '@admin/config/main.php',
                '@admin/config/main-local.php',
            ],
            'app-frontend' => [
                '@common/config/main.php',
                '@common/config/main-local.php',
                '@frontend/config/main.php',
                '@frontend/config/main-local.php',
            ],
            'app-penjual' => [
                '@common/config/main.php',
                '@common/config/main-local.php',
                '@penjual/config/main.php',
                '@penjual/config/main-local.php',
            ],
        ],
    ],
    'pusher.app_id'=>$ini['pusher_app_id'],
    'pusher.key'=>$ini['pusher_key'],
    'pusher.secret'=>$ini['pusher_secret'],
    'pusher.cluster'=>$ini['pusher_cluster']
];
