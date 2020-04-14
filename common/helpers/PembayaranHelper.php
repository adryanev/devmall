<?php


namespace common\helpers;


class PembayaranHelper
{

    const STATUS_SUCCESS = 1;
    const STATUS_PENDING = 0;
    const STATUS_DENIED = 3;
    const STATUS_EXPIRED = 4;
    const STATUS_CHALLENGED = 5;

    const JENIS_PRODUK = 1;
    const JENIS_PERMINTAAN = 2;
    const JENIS_CICILAN = 3;

    const JENIS = [
        self::JENIS_PRODUK => 'Produk',
        self::JENIS_PERMINTAAN => 'Permintaan',
        self::JENIS_CICILAN => 'Cicilan'
    ];

    const STATUS = [
        self::STATUS_PENDING => 'Pending',
        self::STATUS_SUCCESS => 'Success',
        self::STATUS_EXPIRED =>'Expired',
        self::STATUS_CHALLENGED =>'Challenged by FDS',
        self::STATUS_DENIED =>'Denied',
    ];
}
