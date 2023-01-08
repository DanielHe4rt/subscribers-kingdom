<?php

namespace Kingdom\Integrations\Twitch\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Kingdom\Integrations\Twitch\Domain\Interfaces\TwitchService;
use Kingdom\Integrations\Twitch\Infrastructure\Client\TwitchClient;

class TwitchIntegrationProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TwitchService::class, TwitchClient::class);
    }
}
