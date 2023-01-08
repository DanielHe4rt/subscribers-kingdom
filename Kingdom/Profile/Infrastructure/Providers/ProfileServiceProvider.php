<?php

namespace Kingdom\Profile\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;

class ProfileServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../Presentation/Views', 'profile');
    }
}
