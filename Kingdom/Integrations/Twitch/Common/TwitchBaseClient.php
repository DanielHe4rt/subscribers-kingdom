<?php

namespace Kingdom\Integrations\Twitch\Common;

use GuzzleHttp\Client;

class TwitchBaseClient implements TwitchService
{

    public function __construct(private readonly Client $client)
    {
    }

    public function oauth(): TwitchOAuthService
    {
        return new TwitchOAuthClient($this->client);
    }

    public function subscribers(): TwitchSubscribersService
    {
        // TODO: Implement subscribers() method.
    }
}
