<?php
return [
    'openbase' => [
        'driver'         => 'OpenSQL',
        'host'           => env('DB_HOST', '127.0.0.1'),
        'database'       => env('DB_DATABASE', ''),
        'username'       => env('DB_USERNAME', '1'),
        'password'       => env('DB_PASSWORD', 'a'),
    ],
];
