<?php

namespace Kingdom\Authentication\Application;

use Kingdom\Authentication\Domain\Actions\GetOAuthUser;
use Kingdom\Integrations\Shared\Enums\OAuthProviderEnum;

class AuthenticateService
{
    public function __construct(
        private readonly GetOAuthUser $getUserAction
    )
    {
    }

    public function handle(string $provider, string $code)
    {
        $user = $this->getUserAction->handle($provider, $code);
    }
}
