<?php

namespace Kingdom\Integrations;

use Kingdom\Core\Contracts\DomainInterface;
use Kingdom\Integrations\Twilio\Common\TwilioIntegrationProvider;
use Kingdom\Integrations\Twitch\Common\TwitchIntegrationProvider;

class IntegrationsDomain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            TwitchIntegrationProvider::class,
            TwilioIntegrationProvider::class
        ];
    }
}
