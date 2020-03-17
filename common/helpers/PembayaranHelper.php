<?php


namespace common\helpers;


class PembayaranHelper
{

    const STATUS_SUCCESS = 1;
    const STATUS_PENDING = 0;
    const STATUS_FAILED = 3;
    const STATUS_EXPIRED = 4;

    const STATUS = [
        self::STATUS_PENDING => 'Pending',
        self::STATUS_SUCCESS => 'Success',
        self::STATUS_FAILED => 'Failed',
        self::STATUS_EXPIRED =>'Expired'
    ];
}
