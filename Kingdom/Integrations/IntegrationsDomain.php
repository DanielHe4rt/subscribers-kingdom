<?php

namespace Kingdom\Integrations;

use Kingdom\Core\Contracts\DomainInterface;
use Kingdom\Integrations\Twitch\Providers\TwitchIntegrationProvider;

class IntegrationsDomain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            TwitchIntegrationProvider::class
        ];
    }
}
