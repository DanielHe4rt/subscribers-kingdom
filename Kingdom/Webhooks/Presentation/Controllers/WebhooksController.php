<?php

namespace Kingdom\Webhooks\Presentation\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kingdom\Webhooks\Application\SubscriptionWebhook;
use Kingdom\Webhooks\Domain\Enums\SubscriptionProvidersEnum;

class WebhooksController
{
    public function getWebhooks(
        Request             $request,
        string              $provider,
        SubscriptionWebhook $webhookHandler
    ): Response
    {
        // TODO: verify keys by provider with a middleware maybe?
        $webhookHandler->byProvider(SubscriptionProvidersEnum::from($provider), $request->all());
        return response()->noContent();
    }
}
