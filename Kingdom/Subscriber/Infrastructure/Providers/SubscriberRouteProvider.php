<?php

namespace Kingdom\Subscriber\Infrastructure\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Kingdom\Subscriber\Presentation\Controllers\SubscribersController;

class SubscriberRouteProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::prefix('subscribers')->group(function () {
            Route::get('/', [SubscribersController::class, 'getSubscribers']);
        });

    }
}
