<?php

namespace Kingdom\Authentication\OAuth\Domain\Actions;

use Kingdom\Authentication\OAuth\Infrastructure\Enums\OAuthProviderEnum;

class RedirectOAuthUrl
{
    public function handle(string $provider): string
    {
        return OAuthProviderEnum::from($provider)
            ->getProvider()
            ->redirectUrl();
    }
}
