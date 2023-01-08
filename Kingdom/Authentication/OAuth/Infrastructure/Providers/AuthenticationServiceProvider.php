<?php

namespace Kingdom\Authentication\OAuth\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Kingdom\Authentication\OAuth\Domain\Repositories\ProviderRepository;
use Kingdom\Authentication\OAuth\Domain\Repositories\TokenRepository;
use Kingdom\Authentication\OAuth\Infrastructure\Repositories\ProviderEloquentRepository;
use Kingdom\Authentication\OAuth\Infrastructure\Repositories\TokenEloquentRepository;

class AuthenticationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ProviderRepository::class, ProviderEloquentRepository::class);
        $this->app->bind(TokenRepository::class, TokenEloquentRepository::class);
    }
}
