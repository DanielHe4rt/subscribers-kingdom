<?php

namespace Kingdom\Subscription;

use Kingdom\Core\Contracts\DomainInterface;
use Kingdom\Subscription\Infrastructure\Providers\SubscriptionServiceProvider;

class SubscriptionDomain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            SubscriptionServiceProvider::class
        ];
    }
}
