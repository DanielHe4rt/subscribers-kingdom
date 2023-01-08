<?php

namespace Kingdom\Integrations;

use Kingdom\Core\Contracts\DomainInterface;
use Kingdom\Integrations\Twitch\Common\TwitchIntegrationProvider;

class IntegrationsDomain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            TwitchIntegrationProvider::class
        ];
    }
}
