<?php

namespace Kingdom\Authentication\OAuth\Infrastructure\Enums;

use Kingdom\Authentication\OAuth\Domain\Interfaces\OAuthClientContract;
use Kingdom\Integrations\Github\OAuth\Domain\Contracts\GithubOAuthContract;
use Kingdom\Integrations\Twitch\OAuth\Domain\TwitchOAuthService;


enum OAuthProviderEnum: string
{
    case Twitch = 'twitch';
    case Github = 'github';

    public function getProvider(): OAuthClientContract
    {
        return match($this) {
            self::Twitch => app(TwitchOAuthService::class),
            self::Github => app(GithubOAuthContract::class),
        };
    }
}
