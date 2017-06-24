<?php

return [
    // Slim
    'settings' => [
        'displayErrorDetails' => true,

        // Database
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'slim_authentication',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]
    ]
];