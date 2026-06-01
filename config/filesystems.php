<?php

$supabaseS3CaBundle = env('SUPABASE_S3_CA_BUNDLE');
$supabaseS3Endpoint = env('SUPABASE_S3_ENDPOINT');

if (is_string($supabaseS3Endpoint) && preg_match('#^https://([a-z0-9-]+)\.supabase\.co/storage/v1/s3/?$#i', $supabaseS3Endpoint, $matches) === 1) {
    $supabaseS3Endpoint = 'https://'.$matches[1].'.storage.supabase.co/storage/v1/s3';
}

if (! $supabaseS3CaBundle) {
    foreach ([
        'C:\\Program Files\\Git\\mingw64\\ssl\\certs\\ca-bundle.crt',
        'C:\\Program Files\\Git\\usr\\ssl\\certs\\ca-bundle.crt',
        'C:\\Program Files\\Git\\mingw64\\bin\\curl-ca-bundle.crt',
        'C:\\xampp\\apache\\bin\\curl-ca-bundle.crt',
    ] as $candidate) {
        if (is_file($candidate)) {
            $supabaseS3CaBundle = $candidate;
            break;
        }
    }
}

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    'product_disk' => env('SUPABASE_BUCKET') && env('SUPABASE_S3_ENDPOINT') && env('SUPABASE_S3_KEY') && env('SUPABASE_S3_SECRET')
        ? 'supabase_storage'
        : 'public',

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => rtrim(env('APP_URL', 'http://localhost'), '/').'/storage',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
            'report' => false,
        ],

        'supabase_storage' => [
            'driver' => 's3',
            'key' => env('SUPABASE_S3_KEY'),
            'secret' => env('SUPABASE_S3_SECRET'),
            'region' => env('SUPABASE_REGION', config('services.supabase.region', 'us-east-1')),
            'bucket' => env('SUPABASE_BUCKET'),
            'endpoint' => $supabaseS3Endpoint,
            'url' => env('SUPABASE_URL') && env('SUPABASE_BUCKET')
                ? rtrim(env('SUPABASE_URL'), '/').'/storage/v1/object/public/'.env('SUPABASE_BUCKET')
                : null,
            'use_path_style_endpoint' => true,
            'http' => [
                'verify' => $supabaseS3CaBundle ?: true,
            ],
            'throw' => false,
            'report' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
