<?php

namespace Kingdom\Subscriber;

use Kingdom\Core\Contracts\DomainInterface;
use Kingdom\Subscriber\Infrastructure\Providers\SubscriberRouteProvider;
use Kingdom\Subscriber\Infrastructure\Providers\SubscriberServiceProvider;

class Domain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            SubscriberRouteProvider::class,
            SubscriberServiceProvider::class
        ];
    }
}
