<?php

namespace Kingdom\Integrations\Twitch\Common;

use Illuminate\Support\ServiceProvider;
use Kingdom\Integrations\Twitch\OAuth\Domain\TwitchOAuthService;
use Kingdom\Integrations\Twitch\OAuth\Infrastructure\TwitchOAuthClient;

class TwitchIntegrationProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TwitchService::class, TwitchBaseClient::class);
        $this->app->bind(TwitchOAuthService::class, TwitchOAuthClient::class);
    }
}
