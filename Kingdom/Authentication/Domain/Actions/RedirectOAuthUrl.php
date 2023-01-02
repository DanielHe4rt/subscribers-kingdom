<?php

namespace Kingdom\Authentication\Domain\Actions;

use Kingdom\Integrations\Shared\Enums\OAuthProviderEnum;

class RedirectOAuthUrl
{
    public function handle(string $provider): string
    {
        return OAuthProviderEnum::from($provider)
            ->getProvider()
            ->redirectUrl();
    }
}
