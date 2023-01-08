<?php

namespace Kingdom\Authentication;

use Kingdom\Authentication\OAuth\Infrastructure\Providers\AuthenticationRouteProvider;
use Kingdom\Authentication\OAuth\Infrastructure\Providers\AuthenticationServiceProvider;
use Kingdom\Core\Contracts\DomainInterface;

class AuthenticationDomain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            AuthenticationServiceProvider::class,
            AuthenticationRouteProvider::class
        ];
    }
}
