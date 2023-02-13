<?php

namespace Kingdom\Integrations\Twitch\Common;

use GuzzleHttp\Client;
use Kingdom\Integrations\Twitch\EventSub\Domain\TwitchEventSubService;
use Kingdom\Integrations\Twitch\EventSub\Infrastructure\TwitchEventSubClient;
use Kingdom\Integrations\Twitch\Subscriber\Infrastructure\TwitchSubscribersClient;
use Kingdom\Integrations\Twitch\OAuth\Domain\TwitchOAuthService;
use Kingdom\Integrations\Twitch\Subscriber\Domain\TwitchSubscribersService;
use Kingdom\Integrations\Twitch\OAuth\Infrastructure\TwitchOAuthClient;

final class TwitchBaseClient implements TwitchService
{

    public function __construct(private Client $client)
    {
    }

    public function oauth(): TwitchOAuthService
    {
        return new TwitchOAuthClient($this->client);
    }

    public function subscribers(): TwitchSubscribersService
    {
        return new TwitchSubscribersClient($this->client);
    }

    public function eventSub(): TwitchEventSubService
    {
        return new TwitchEventSubClient($this->client);
    }
}
