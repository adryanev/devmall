<?php


namespace frontend\helpers;


class FlashHelper
{

    const SUCCESS = [
        'type' => 'success',
        'icon' => 'fas fa-check',
        'message' => '',
        'title' => 'Berhasil!',
    ];

    const DANGER = [
        'type' => 'danger',
        'icon' => 'fas fa-times',
        'message' => 'Gagal',
        'title' => 'Oops Terjadi Kesalahan!',
    ];

    const WARNING = [
        'type' => 'warning',
        'icon' => 'fas fa-exclamation',
        'message' => 'Terjadi kesalahan',
        'title' => 'Peringatan!',
    ];

    const INFO = [
        'type' => 'warning',
        'icon' => 'fas fa-info',
        'message' => 'Ada Info',
        'title' => 'Info!',
    ];
}