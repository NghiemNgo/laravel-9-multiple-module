<?php

return [
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => env("DB_HOST", "127.0.0.1"),
            'port' => env("DB_PORT", 3306),
            'database' => env("DB_DATABASE", "invest"),
            'username' => env("DB_USERNAME", "root"),
            'password' => env("DB_PASSWORD", "secret"),
            //'unix_socket' => env("DB_SOCKET", ""),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
    ]
];