<?php

namespace Kingdom\Authentication\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Kingdom\Authentication\Domain\Repositories\ProviderRepository;
use Kingdom\Authentication\Domain\Repositories\TokenRepository;
use Kingdom\Authentication\Infrastructure\Repositories\ProviderEloquentRepository;
use Kingdom\Authentication\Infrastructure\Repositories\TokenEloquentRepository;

class AuthenticationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ProviderRepository::class, ProviderEloquentRepository::class);
        $this->app->bind(TokenRepository::class, TokenEloquentRepository::class);
    }
}
