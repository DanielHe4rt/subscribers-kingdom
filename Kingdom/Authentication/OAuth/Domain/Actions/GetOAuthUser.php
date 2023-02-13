<?php

namespace Kingdom\Authentication\OAuth\Domain\Actions;

use Kingdom\Authentication\OAuth\Domain\DTO\OAuthUserDTO;
use Kingdom\Authentication\OAuth\Infrastructure\Enums\OAuthProviderEnum;

class GetOAuthUser
{
    public function handle(string $provider, string $code): OAuthUserDTO
    {
        $oauthProvider = OAuthProviderEnum::from($provider)->getProvider();

        return $oauthProvider->getAuthenticatedUser($oauthProvider->auth($code));
    }
}
