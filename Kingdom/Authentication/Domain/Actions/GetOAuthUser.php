<?php

namespace Kingdom\Authentication\Domain\Actions;

use Kingdom\Integrations\Shared\DTO\OAuthUserDTO;
use Kingdom\Integrations\Shared\Enums\OAuthProviderEnum;

class GetOAuthUser
{
    public function handle(string $provider, string $code): OAuthUserDTO
    {
        $oauthProvider = OAuthProviderEnum::from($provider)->getProvider();

        return $oauthProvider->getAuthenticatedUser(
            $oauthProvider->auth($code)
        );
    }
}
