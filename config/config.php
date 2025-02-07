<?php

return [

    'database' => [
        'driver' => 'sqlite',
        'database' => base_path('database/lockbox.sqlite')
    ],
    'security' =>[
        'first_key' => env('ENCRYPT_FIRST_KEY', 'first_key'),
        'second_key' => env('ENCRYPT_SECOND_KEY', 'second_key')
    ]
];
