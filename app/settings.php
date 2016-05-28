<?php

return [
    'settings' => [
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => false,
        'view' => [
            'template_path' => __DIR__ . '/../resources/views',
            'twig' => [
                'cache' => __DIR__ . '/../cache/twig',
                'debug' => true,
                'auto_reload' => true,
            ],
        ],
        'logger' => [
            'name' => 'app',
            'path' => __DIR__ . '/../logs/app.log',
        ],
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'slim3_authentication',
            'username' => 'root',
            'password' => 'password',
            'charset' => 'utf8',
            'collaction' => 'utf8_unicode_ci',
            'prefix' => '',
        ],
    ],
];