<?php

namespace Kingdom\Subscriber\Infrastructure\Observers;

use Kingdom\Subscriber\Infrastructure\Models\Subscriber;
use Kingdom\Subscription\Infrastructure\Models\Subscription;

class SubscriberObserver
{
    public function created(Subscriber $subscriber)
    {
        Subscription::query()
            ->where('username', $subscriber->username)
            ->each(fn (Subscription $subscription) => $subscription->update(['subscriber_id' => $subscriber->id]));
    }
}
