<?php

namespace Kingdom\Authentication\OAuth\Infrastructure\Enums;

use Kingdom\Authentication\OAuth\Domain\Interfaces\OAuthClientContract;
use Kingdom\Integrations\Twitch\Infrastructure\Client\TwitchClient;

enum OAuthProviderEnum: string
{
    case Twitch = 'twitch';

    public function getProvider(): OAuthClientContract
    {
        return match($this) {
            self::Twitch => app(TwitchClient::class)
        };
    }
}
