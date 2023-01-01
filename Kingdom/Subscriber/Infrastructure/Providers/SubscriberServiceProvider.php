<?php

namespace Kingdom\Subscriber\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Kingdom\Subscriber\Domain\Repositories\SubscribersRepository;
use Kingdom\Subscriber\Infrastructure\Repositories\SubscribersEloquentRepository;

class SubscriberServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SubscribersRepository::class, SubscribersEloquentRepository::class);
    }
}
