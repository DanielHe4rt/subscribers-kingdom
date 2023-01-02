<?php

namespace Kingdom\Authentication;

use Kingdom\Authentication\Infrastructure\Providers\AuthenticationRouteProvider;
use Kingdom\Authentication\Infrastructure\Providers\AuthenticationServiceProvider;
use Kingdom\Core\Contracts\DomainInterface;

class AuthDomain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            AuthenticationServiceProvider::class,
            AuthenticationRouteProvider::class
        ];
    }
}
