<?php

namespace Kingdom\Subscriber\Infrastructure\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class UserRouteProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::get('/users', fn () => 'vai caralho');
    }
}
