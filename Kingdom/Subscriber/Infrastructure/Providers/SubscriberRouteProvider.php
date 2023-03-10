<?php

namespace Kingdom\Subscriber\Infrastructure\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Kingdom\Subscriber\Presentation\Controllers\SubscribersController;

class SubscriberRouteProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::prefix('subscribers')
            ->middleware(['web', 'auth:web'])
            ->group(function () {
                Route::get('/', [SubscribersController::class, 'getSubscribers']);
                Route::post('/mobile/send-code', [SubscribersController::class, 'postPhoneVerification'])
                    ->name('subscribers.send-code');
                Route::post('/mobile/verify', [SubscribersController::class, 'postVerifyPhone'])
                    ->name('subscribers.verify');
            });

    }
}
