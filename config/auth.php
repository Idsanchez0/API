<?php

return [
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],

    'guards' => [
        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],

        'app_api' => [
            'driver' => 'passport',
            'provider' => 'app_users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \App\Models\User::class
        ],

        'app_users' => [
            'driver' => 'eloquent',
            'model' => \App\Models\App\AppUser::class
        ],
    ]
];
