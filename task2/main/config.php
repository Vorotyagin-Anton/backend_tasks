<?php

// в конфигурации указаны основные параметры и подключаемые компоненты (классы) для работы класса app\main\Container.

return [
    'defaultController' => 'main',
    'components' => [
        'db' => [
            'class' => \app\services\DB::class,
            'config' => [
                'driver' => 'mysql',
                'host' => 'localhost',
                'db' => 'handbook',
                'charset' => 'UTF8',
                'login' => 'root',
                'password' => 'root',
            ]
        ],
        'request' => [
            'class' => \app\services\Request::class,
        ],
        'renderer' => [
            'class' => \app\services\TwigRenderServices::class,
        ],
        'userRepository' => [
            'class' => \app\repositories\UserRepository::class,
        ],
        'phoneRepository' => [
            'class' => \app\repositories\PhoneRepository::class,
        ],
    ],
];