<?php

namespace Kingdom\Integrations\Shared\Domain\Interfaces;

use Kingdom\Integrations\Shared\Domain\DTO\OAuthUserDTO;

interface OAuthContract
{
    public static function redirectUrl(): string;
    public function auth(string $code);

    public function getAuthenticatedUser(string $accessToken): OAuthUserDTO;
}
