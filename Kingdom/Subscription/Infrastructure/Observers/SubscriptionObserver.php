<?php

namespace Kingdom\Subscription\Infrastructure\Observers;

use Kingdom\Authentication\OAuth\Infrastructure\Models\Provider;
use Kingdom\Subscription\Infrastructure\Models\Subscription;

class SubscriptionObserver
{
    public function creating(Subscription $subscription)
    {
        $provider = Provider::where('provider', $subscription->provider)
            ->where('provider_username', $subscription->username)
            ->first();


        $subscription->subscriber_id = $provider->subscriber_id ?? null;
    }
}
