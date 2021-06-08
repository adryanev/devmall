<?php

return [
    'superadmin' => [
        'type' => 1,
        'children' => [
            '@app-admin/*',
            '@app-penjual/*',
            '@app-frontend/*',
        ],
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            '@app-admin/*',
            '@app-penjual/*',
            '@app-frontend/*',
        ],
    ],
    'penjual' => [
        'type' => 1,
        'children' => [
            '@app-penjual/*',
        ],
    ],
    'pengguna' => [
        'type' => 1,
        'children' => [
            '@app-frontend/*',
        ],
    ],
    '@app-admin/*' => [
        'type' => 2,
    ],
    '@app-penjual/*' => [
        'type' => 2,
    ],
    '@app-frontend/*' => [
        'type' => 2,
    ],
    '@app-frontend/permintaan/*' => [
        'type' => 2,
    ],
];
