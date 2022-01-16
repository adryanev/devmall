<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=devmall_dev',
            'username' => 'devmall_user',
            'password' => 'secret',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
            // 'transport'=>[
            //     'class'=>'Swift_SmtpTransport',
            //     'host'=>'smtp.gmail.com',
            //     'username'=>'petya.orlov14@gmail.com',
            //     'password'=>'Qwerty21+',
            //     'port'=>587,
            //     'encryption'=>'tls'
            // ]
        ],
        // 'mailer' => [
        //     'class'            => 'gulltour\phpmailer\Mailer',
        //     'viewPath'         => '@common/mail',
        //     'useFileTransport' => false,
        //     'config'           => [
        //         'mailer'     => 'smtp',
        //         'host'       => 'smtp.gmail.com',
        //         'port'       => '465',
        //         'smtpsecure' => 'ssl',
        //         'smtpauth'   => false,
        //         'username'   => 'petya.orlov14@gmail.com',
        //         'password'   => 'Qwerty21+',
        //     ],
        // ],
    ],
];
