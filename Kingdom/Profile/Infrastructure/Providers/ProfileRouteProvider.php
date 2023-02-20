<?php

namespace Kingdom\Profile\Infrastructure\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Kingdom\Landing\Presentation\Controllers\LandingController;
use Kingdom\Profile\Presentation\Controllers\ProfileController;

class ProfileRouteProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::prefix('profile')
            ->middleware(['web','auth:web'])
            ->group(function () {
                Route::get('/', [ProfileController::class, 'getProfile'])->name('profile');
                Route::get('/history', [ProfileController::class, 'viewSubscriptionHistory'])
                    ->name('history');
            });
    }
}
