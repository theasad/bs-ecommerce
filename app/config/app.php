<?php
defined('DIRECT_ACCESS_ALLOWED') or exit('No direct script access allowed');
return [
    'database' => [
        'host' => env('DATABASE_HOST'),
        'port' => env('DATABASE_PORT'),
        'dbname' => env('DATABASE_NAME'),
        'username' => env('DATABASE_USERNAME'),
        'password' => env('DATABASE_PASSWORD'),
    ]
];
