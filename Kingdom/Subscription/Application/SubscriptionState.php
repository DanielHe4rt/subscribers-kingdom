<?php

namespace Kingdom\Subscription\Application;

use Illuminate\Support\Facades\Cache;
use Kingdom\Integrations\Twitch\Subscriber\Domain\DTO\TwitchSubscriberDTO;
use Kingdom\Subscription\Domain\Actions\GetSubscriptionStatus;

class SubscriptionState
{
    public function __construct(private GetSubscriptionStatus $action)
    {
    }

    public function handle(string $subscriberId, string $provider): ?TwitchSubscriberDTO
    {
        // TODO: this should handle every subscription state at same time
        // TODO: maybe return an collection of status? I don't know actually.
        $cacheKey = sprintf('subscriber-%s-%s', $subscriberId, $provider);
        return Cache::remember(
            $cacheKey,
            60 * 60 * 24,
            fn() => $this->action->handle($subscriberId, $provider)
        );
    }
}
