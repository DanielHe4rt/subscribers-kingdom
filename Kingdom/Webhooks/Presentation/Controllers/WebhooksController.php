<?php

namespace Kingdom\Webhooks\Presentation\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Kingdom\Webhooks\Application\SubscriptionWebhook;
use Kingdom\Webhooks\Domain\Enums\SubscriptionProvidersEnum;

class WebhooksController
{
    public function getWebhooks(
        Request             $request,
        string              $provider,
        SubscriptionWebhook $webhookHandler
    )
    {
        // TODO: verify keys by provider with a middleware maybe?
        Log::alert('[Sponsorship Payload]', [
            'content' => $request->all()
        ]);

        if ($request->has('challenge')) {
            return response($request->input('challenge'));
        }

        if ($provider == 'github') {
            return response('se fude');
        }

        $webhookHandler->byProvider(SubscriptionProvidersEnum::from($provider), $request->all());
        return response()->noContent();
    }
}
