<?php

return [
    'secret_passphrase' => 'fodase',
    'sms_provider' => 'telesign',
    'integrations' => [
        'twitch' => [
            'channel_id' => '227168488',
            'client_id' => env('TWITCH_OAUTH_CLIENT_ID'),
            'client_secret' => env('TWITCH_OAUTH_CLIENT_SECRET'),
            'redirect_uri' => env('TWITCH_OAUTH_REDIRECT_URI'),
            'scopes' => env('TWITCH_OAUTH_SCOPES')
        ],
        'github' => [
            'channel_id' => '227168488',
            'client_id' => env('GITHUB_OAUTH_CLIENT_ID'),
            'client_secret' => env('GITHUB_OAUTH_CLIENT_SECRET'),
            'redirect_uri' => env('GITHUB_OAUTH_REDIRECT_URI'),
            'scopes' => env('GITHUB_OAUTH_SCOPES', 'user')
        ],
        'twilio' => [
            'sid' => env('TWILIO_SID', '123'),
            'secret' => env('TWILIO_SECRET', '123'),
            'sender_phone' => env('TWILIO_SENDER', '+14155238886')
        ],
        'telesign' => [
            'customer_id' => env('TELESIGN_SID', '123'),
            'secret' => env('TELESIGN_SECRET', '123'),
            'sender_phone' => env('TELESIGN_SENDER', '+14155238886')
        ],

    ]
];
