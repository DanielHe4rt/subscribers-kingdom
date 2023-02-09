<?php

namespace Kingdom\Landing\Infrastructure\Provider;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Kingdom\Landing\Presentation\Controllers\LandingController;

class LandingRouteProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::get('/', [LandingController::class, 'viewLanding'])
            ->middleware('web')
            ->name('landing');
    }
}
