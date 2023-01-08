<?php

namespace Kingdom\Integrations\Twitch\Subscriber\Infrastructure;

use GuzzleHttp\Client;
use Kingdom\Integrations\Twitch\Domain\DTO\TwitchOAuthDTO;
use Kingdom\Integrations\Twitch\Domain\Interfaces\TwitchSubscribersService;

class TwitchSubscribersClient implements TwitchSubscribersService
{
    public function __construct(private readonly Client $client)
    {
    }

    public function getSubscriptionState(string $twitchId, string $channelId)
    {
        $uri = "https://api.twitch.tv/helix/users";
        $response = $this->client->request('GET', $uri, [
            'headers' => [
                'Client-ID' => config('kingdom.integrations.twitch.client_id'),
                'Authorization' => 'Bearer ' . $credentials->accessToken,
            ]
        ]);

        $payload = json_decode($response->getBody()->getContents(), true);
        return TwitchOAuthDTO::make($credentials, $payload);
    }
}
