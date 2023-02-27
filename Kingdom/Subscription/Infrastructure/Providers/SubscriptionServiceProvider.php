<?php

namespace Kingdom\Subscription\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Kingdom\Subscription\Domain\Repository\SubscriptionRepository;
use Kingdom\Subscription\Infrastructure\Models\Subscription;
use Kingdom\Subscription\Infrastructure\Observers\SubscriptionObserver;
use Kingdom\Subscription\Infrastructure\Repositories\SubscriptionEloquentRepository;

class SubscriptionServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(SubscriptionRepository::class, SubscriptionEloquentRepository::class);
    }

    public function boot()
    {
        Subscription::observe(SubscriptionObserver::class);
    }
}
