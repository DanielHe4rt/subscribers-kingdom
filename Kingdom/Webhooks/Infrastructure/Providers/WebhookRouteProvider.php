<?php

namespace Kingdom\Webhooks\Infrastructure\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Kingdom\Webhooks\Presentation\Controllers\WebhooksController;

class WebhookRouteProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::post('/webhooks/{provider}', [WebhooksController::class, 'getWebhooks'])->name('weebhooks-handler');
    }
}
