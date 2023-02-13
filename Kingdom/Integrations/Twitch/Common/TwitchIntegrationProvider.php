<?php

namespace Kingdom\Integrations\Twitch\Common;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Kingdom\Integrations\Twitch\OAuth\Domain\TwitchOAuthService;
use Kingdom\Integrations\Twitch\OAuth\Infrastructure\TwitchOAuthClient;

class TwitchIntegrationProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TwitchService::class, function () {
            $client = new Client([
                'headers' => ['Client-Id' => config('kingdom.integrations.twitch.client_id')]
            ]);
            return new TwitchBaseClient($client);
        });
        $this->app->bind(TwitchOAuthService::class, TwitchOAuthClient::class);
    }
}
