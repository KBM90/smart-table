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

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'paddle' => [
        'price_monthly' => env('PADDLE_PRICE_MONTHLY'),
        'price_annual' => env('PADDLE_PRICE_ANNUAL'),
    ],

    'supabase' => [
        'url' => env('SUPABASE_URL'),
        'anon_key' => env('SUPABASE_ANON_KEY'),
        'service_role' => env('SUPABASE_SERVICE_ROLE_KEY'),
        'realtime_anon_enabled' => env('SUPABASE_REALTIME_ANON_ENABLED', false),
        'bucket' => env('SUPABASE_BUCKET'),
        's3_endpoint' => env('SUPABASE_S3_ENDPOINT'),
        'region' => env('SUPABASE_REGION', 'us-east-1'),
        's3_key' => env('SUPABASE_S3_KEY'),
        's3_secret' => env('SUPABASE_S3_SECRET'),
    ],

];
