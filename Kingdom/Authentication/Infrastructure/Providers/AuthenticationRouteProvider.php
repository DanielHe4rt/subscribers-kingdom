<?php

namespace Kingdom\Authentication\Infrastructure\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Kingdom\Authentication\Presentation\Controllers\OAuthController;

class AuthenticationRouteProvider extends RouteServiceProvider
{
    public function map(): void
    {

        Route::prefix('auth')->group(function () {
            Route::prefix('oauth')->group(function () {
                Route::get('/{provider}', [OAuthController::class, 'getAuthenticate']);
                Route::get('/{provider}/redirect', [OAuthController::class, 'getRedirect']);
            });
        });
    }
}
