<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    
    'google' => [
        'client_id' => '361435103369-h1doiofih0dj1vhhaevdl5hibsm9idoq.apps.googleusercontent.com',
        'client_secret' => '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',
            'redirect' => 'http://127.0.0.1:8000/auth/google/callback',
        ],

            'facebook' => [
                'client_id' => '1104780617354684',
                'client_secret' => '8c4d68437a7a8ea2ac68957b11a9b963',
                'redirect' => 'http://127.0.0.1:8000/auth/facebook/callback',
            ],
];
