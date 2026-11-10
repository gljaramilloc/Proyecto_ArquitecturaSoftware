<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Resend, Postmark, AWS, and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    // Vehicle rental JSON service published by the allied team (consumed in /vehiculos-aliados)
    'allied_vehicles' => [
        'url' => env('ALLIED_SERVICE_URL'),
        'timeout' => env('ALLIED_SERVICE_TIMEOUT', 5),
    ],

    // External exchange rate API (USD to COP TRM)
    'exchange_rate' => [
        'url' => env('EXCHANGE_RATE_API_URL', 'https://open.er-api.com/v6/latest/USD'),
        'timeout' => env('EXCHANGE_RATE_API_TIMEOUT', 5),
        'cache_ttl' => env('EXCHANGE_RATE_CACHE_TTL', 3600),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];
