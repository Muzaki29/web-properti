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

    /*
    |--------------------------------------------------------------------------
    | WhatsApp (wa.me deep links)
    |--------------------------------------------------------------------------
    |
    | Digits only, country code included (e.g. 62812... for Indonesia).
    | Used for public CTAs and inquiry lead routing.
    |
    */

    'whatsapp' => [
        'phone_e164_digits' => env('WHATSAPP_BUSINESS_PHONE', '6285781780369'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Lead / inquiry notifications
    |--------------------------------------------------------------------------
    */

    'inquiry' => [
        'notify_email' => env('INQUIRY_NOTIFY_EMAIL'),
    ],

];
