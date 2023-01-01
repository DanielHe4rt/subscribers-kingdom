<?php

namespace Kingdom\Subscriber;

use Kingdom\Core\Contracts\DomainInterface;
use Kingdom\Subscriber\Infrastructure\Providers\UserRouteProvider;
use Kingdom\Subscriber\Infrastructure\Providers\UserServiceProvider;

class Domain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            UserRouteProvider::class,
            UserServiceProvider::class
        ];
    }
}
