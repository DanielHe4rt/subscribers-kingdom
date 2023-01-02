<?php

namespace Kingdom\Integrations\Shared\Enums;

use Kingdom\Integrations\Shared\Interfaces\OAuthContract;
use Kingdom\Integrations\Twitch\Client\TwitchClient;

enum OAuthProviderEnum: string
{
    case Twitch = 'twitch';

    public function getProvider(): OAuthContract
    {
        return match($this) {
            self::Twitch => app(TwitchClient::class)
        };
    }
}
