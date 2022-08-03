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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'firebase' => [
        'api_key' => 'AIzaSyArYhjNFAluo3RLD0Uk1oaoIaweMkhbIE8',
        'auth_domain' => 'projectakhir-f0566.firebaseapp.com',
        'database_url' => 'https://projectakhir-f0566-default-rtdb.firebaseio.com/',
        'project_id' => 'projectakhir-f0566.appspot.com',
        'storage_bucket' => 'projectakhir-f0566.appspot.com',
        'messaging_sender_id' => '992650486283',
        'app_id' => '1:992650486283:web:29849de604ebdd0fb2dd0e',
        'measurement_id' => 'G-JSNCMEDM9D',
    ],
];
