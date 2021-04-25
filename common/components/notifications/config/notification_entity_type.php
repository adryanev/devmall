<?php

return [
    1 => [
        'messageProp' => 'transaksi.produk.invoice',
        'name' => 'Transaksi Produk Masuk',
        'preProcess' => null,
        'postProcess' => null,
        'notifier' => 'booth',
        'entity'=>\common\models\TransaksiProduk::class,
        'clickAction' => ['transaksi/view'],
        'clickActionParams' => 'id'
    ],
    2 => [
        'messageProp' => 'transaksi.produk.confirmed',
        'name' => 'Transaksi Produk Telah dibayar',
        'preProcess' => null,
        'postProcess' => null,
        'notifier' => 'booth',
        'clickAction' => ['transaksi/view'],
        'clickActionParams' => 'id'
    ],
    3 => [
        'messageProp' => 'transaksi.produk.completed',
        'name' => 'Transaksi Produk telah selesai',
        'preProcess' => null,
        'postProcess' => null,
        'notifier' => 'user',
        'clickAction' => ['transaksi/view'],
        'clickActionParams' => 'id'
    ],
    4 => [
        'messageProp' => 'transaksi.produk.canceled',
        'name' => 'Transaksi Produk dibatalkan.',
        'preProcess' => null,
        'postProcess' => null,
        'notifier' => 'booth',
        'clickAction' => ['transaksi/view'],
        'clickActionParams' => 'id'
    ],
    5 => [
        'messageProp' => 'transaksi.cicilan.due',
        'name' => 'Transaksi sudah jatuh tempo',
        'preProcess' => null,
        'postProcess' => null,
        'notifier' => 'user',
        'clickAction' => ['cicilan/view'],
        'clickActionParams' => 'id'
    ],
    6 => [
        'messageProp' => 'transaksi.cicilan.paid',
        'name' => 'User membayar cicilan',
        'preProcess' => null,
        'postProcess' => null,
        'notifier' => 'booth',
        'clickAction' => ['transaksi/view'],
        'clickActionParams' => 'id'
    ],
    7 => [
        'messageProp' => 'permintaan.produk.dikirim',
        'name' => 'User mengirimkan permintaan produk kepada booth',
        'preProcess' => null,
        'postProcess' => null,
        'notifier' => 'booth',
        'clickAction' => ['permintaan/view'],
        'clickActionParams' => 'id'
    ],
    8 => [
        'messageProp' => 'permintaan.produk.diterima',
        'name' => 'Booth menerima permintaan produk',
        'preProcess' => null,
        'postProcess' => null,
        'notifier' => 'user',
        'clickAction' => ['permintaan/view'],
        'clickActionParams' => 'id'
    ],
    9 => [
        'messageProp' => 'permintaan.produk.ditolak',
        'name' => 'Booth menolak permintaan produk',
        'preProcess' => null,
        'postProcess' => null,
        'notifier' => 'user',
        'clickAction' => ['permintaan/view'],
        'clickActionParams' => 'id'
    ],
    10 => [
        'messageProp' => 'permintaan.produk.progress.update',
        'name' => 'Booth mengupdate progress permintaan produk',
        'preProcess' => null,
        'postProcess' => null,
        'notifier' => 'user',
        'clickAction' => ['permintaan/view'],
        'clickActionParams' => 'id'
    ],
    11 => [
        'messageProp' => 'produk.favorite.discount',
        'name' => 'Booth menambahkan diskon untuk produk',
        'preProcess' => null,
        'postProcess' => null,
        'notifier' => 'user',
        'clickAction' => ['produk/view'],
        'clickActionParams' => 'id'
    ],
];
