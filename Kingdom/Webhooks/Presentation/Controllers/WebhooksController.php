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
        $subscriptionProvidersEnum = SubscriptionProvidersEnum::from($provider);

        $challengeResponse = $request->input($subscriptionProvidersEnum->getChallengeKey());
        if ($challengeResponse) {
            return response($challengeResponse);
        }


        $webhookHandler->byProvider($subscriptionProvidersEnum, $request->all());
        return response()->noContent();
    }
}
