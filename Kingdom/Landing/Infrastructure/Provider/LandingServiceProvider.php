<?php

namespace Kingdom\Landing\Infrastructure\Provider;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Kingdom\Landing\Presentation\Components\Navbar;

class LandingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../Presentation/Views', 'landing');

        Blade::components([Navbar::class], 'landing');
    }
}
