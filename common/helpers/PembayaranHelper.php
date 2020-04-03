<?php


namespace common\helpers;


class PembayaranHelper
{

    const STATUS_SUCCESS = 1;
    const STATUS_PENDING = 0;
    const STATUS_FAILED = 3;
    const STATUS_EXPIRED = 4;

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
        self::STATUS_FAILED => 'Failed',
        self::STATUS_EXPIRED =>'Expired'
    ];
}
