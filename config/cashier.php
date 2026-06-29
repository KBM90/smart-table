<?php

return [
    'seller_id' => env('PADDLE_SELLER_ID'),

    'client_side_token' => env('PADDLE_CLIENT_SIDE_TOKEN', env('PADDLE_CLIENT_TOKEN')),

    'api_key' => env('PADDLE_AUTH_CODE') ?? env('PADDLE_API_KEY'),

    'retain_key' => env('PADDLE_RETAIN_KEY'),

    'webhook_secret' => env('PADDLE_WEBHOOK_SECRET'),

    'path' => env('CASHIER_PATH', 'paddle'),

    'webhook' => env('CASHIER_WEBHOOK'),

    'currency' => env('CASHIER_CURRENCY', 'USD'),

    'currency_locale' => env('CASHIER_CURRENCY_LOCALE', 'en'),

    'sandbox' => filter_var(env('PADDLE_SANDBOX', env('PADDLE_ENVIRONMENT') === 'sandbox'), FILTER_VALIDATE_BOOL),
];
