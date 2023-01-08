<?php

namespace Kingdom\Authentication\OAuth\Domain\Interfaces;

use Kingdom\Authentication\OAuth\Domain\DTO\OAuthAccessDTO;
use Kingdom\Authentication\OAuth\Domain\DTO\OAuthUserDTO;

interface OAuthClientContract
{
    public function redirectUrl(): string;

    public function auth(string $code): OAuthAccessDTO;

    public function getAuthenticatedUser(OAuthAccessDTO $credentials): OAuthUserDTO;
}
