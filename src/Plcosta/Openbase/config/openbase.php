<?php
return [
    'openbase' => [
        'driver'        => 'OpenSQL',
        'hst'           => env('DB_HOST', '127.0.0.1'),
        'dsn'           => env('DB_DATABASE', ''),
        'sec'           => env('DB_USERNAME', '1'),
        'lev'           => env('DB_PASSWORD', 'a'),
        # DB_PATH="HST=${DB_HOST};DSN=${DB_DATABASE};SEC=${DB_USERNAME};LEV=${DB_PASSWORD}
        // 'path'          => env('DB_PATH', '') 
    ],
];
