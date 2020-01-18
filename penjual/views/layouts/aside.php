<?php

use common\widgets\Menu;
use mdm\admin\components\Helper;


$menuItems = [
    [
        'label' => 'Dashboard', 'icon' => "<i class='la la-dashboard'></i>", 'url' => ['/site/index']
    ],
    [
        'label' => 'Produk',
        'icon' => '<i class="la la-android"></i>',
        'url' => ['#'],
        'items' => [
            ['label' => 'Produk', 'icon' => '<i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>', 'url' => ['/produk/index'],],
            [
                'label' => 'Promo',
                'icon' => '<i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>',
                'url' => ['/promo/index'],
            ],
            [
                'label' => 'Diskon',
                'icon' => '<i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>',
                'url' => ['/diskon/index'],
            ],

        ],
    ],

    ['label' => 'Request', 'icon' => '<i class="la la-inbox"></i>', 'url' => ['/request/index'],],
    ['label' => 'Transaksi', 'icon' => '<i class="la la-money"></i>', 'url' => ['/transaksi/index'],
        'items' => [
            ['label' => 'Transaksi Masuk', 'icon' => '<i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>', 'url' => ['/transaksi/masuk'],],
            ['label' => 'Reimburse', 'icon' => '<i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>', 'url' => ['/transaksi/reimburse'],],
        ]
    ],
    ['label' => 'Umpan Balik', 'icon' => '<i class="la la-smile-o"></i>', 'url' => ['/request/index'],],

];
$menuItems = Helper::filter($menuItems);

?>
<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1"
             data-ktmenu-dropdown-timeout="500">


            <?= Menu::widget(

                [
                    'options' => ['class' => 'kt-menu__nav'],
                    'items' => $menuItems,
                ]
            ) ?>
        </div>
    </div>

    <!-- end:: Aside Menu -->
</div>

<!-- end:: Aside -->