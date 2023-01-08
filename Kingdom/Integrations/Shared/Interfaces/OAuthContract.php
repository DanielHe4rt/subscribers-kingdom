<?php

namespace Kingdom\Integrations\Shared\Interfaces;

use Kingdom\Integrations\Shared\DTO\OAuthAccessDTO;
use Kingdom\Integrations\Shared\DTO\OAuthUserDTO;

interface OAuthContract
{
    public function redirectUrl(): string;

    public function auth(string $code): OAuthAccessDTO;

    public function getAuthenticatedUser(OAuthAccessDTO $credentials): OAuthUserDTO;
}
