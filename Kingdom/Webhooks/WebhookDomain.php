<?php

namespace Kingdom\Webhooks;

use Kingdom\Core\Contracts\DomainInterface;
use Kingdom\Webhooks\Infrastructure\Providers\WebhookRouteProvider;

class WebhookDomain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            WebhookRouteProvider::class
        ];
    }
}
