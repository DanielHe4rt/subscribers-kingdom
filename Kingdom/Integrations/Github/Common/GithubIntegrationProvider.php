<?php

namespace Kingdom\Integrations\Github\Common;

use Illuminate\Support\ServiceProvider;
use Kingdom\Integrations\Github\OAuth\Domain\Contracts\GithubOAuthContract;
use Kingdom\Integrations\Github\OAuth\Infrastructure\GithubAuthClient;

class GithubIntegrationProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(GithubService::class, GithubBaseClient::class);
        $this->app->bind(GithubOAuthContract::class, GithubAuthClient::class);
    }
}
