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

    'telegram_sso' => [
        'base_url'        => env('TELEGRAM_API_BASE_URL'),
        'callback_url'    => env('TELEGRAM_CALLBACK_URL'),
        'force_ipv4'      => env('TELEGRAM_FORCE_IPV4', false),
        'force_http_1_1'  => env('TELEGRAM_FORCE_HTTP_1_1', false),
        'timeout'         => env('TELEGRAM_TIMEOUT', 15),
        'connect_timeout' => env('TELEGRAM_CONNECT_TIMEOUT', 5),
        'retry_times'     => env('TELEGRAM_RETRY_TIMES', 1),
        'retry_sleep_ms'  => env('TELEGRAM_RETRY_SLEEP_MS', 500),
    ],

    'sso' => [
        'auth_url'       => env('SSO_AUTH_URL'),
        'data_base_url'  => env('SSO_DATA_BASE_URL'),
        'dev_id'         => env('SSO_LAPOR_DEV_ID') ?: env('SSO_DEV_ID'),
        'x_token'        => env('SSO_LAPOR_X_TOKEN') ?: env('SSO_X_TOKEN'),
        'force_ipv4'     => env('SSO_FORCE_IPV4', false),
        'force_http_1_1' => env('SSO_FORCE_HTTP_1_1', false),
        'me_url'         => env('SSO_ME_URL'),
        'replace_source' => env('SSO_REPLACE_SOURCE'),
        'replace_target' => env('SSO_REPLACE_TARGET'),
        'logout_url'     => env('APP_URL_SSO_LOGOUT'),
    ],

];
