<?php

namespace Kingdom\Authentication\Domain\Actions;

use Kingdom\Integrations\Shared\DTO\OAuthUserDTO;
use Kingdom\Integrations\Shared\Enums\OAuthProviderEnum;

class GetOAuthUser
{
    public function handle(string $provider, string $code): OAuthUserDTO
    {
        $oauthProvider = OAuthProviderEnum::from($provider)
            ->getProvider();

        $access = $oauthProvider->auth($code);
        return $oauthProvider->getAuthenticatedUser($access['access_token']);
    }
}
