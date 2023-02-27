<?php

namespace Kingdom\Subscription\Infrastructure\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Kingdom\Subscription\Domain\DTO\NewSubscriberDTO;
use Kingdom\Subscription\Domain\Entities\SubscriptionEntity;
use Kingdom\Subscription\Domain\Enums\SubscriptionEnum;
use Kingdom\Subscription\Domain\Repository\SubscriptionRepository;
use Kingdom\Subscription\Infrastructure\Models\Subscription;

class SubscriptionEloquentRepository implements SubscriptionRepository
{
    public function create(NewSubscriberDTO $newSubscriber): Subscription
    {
        return Subscription::create($newSubscriber->toDatabase());
    }

    public function paginate(string $subscriberId, int $perPage = 15): LengthAwarePaginator
    {
        return Subscription::query()
            ->where('subscriber_id', $subscriberId)
            ->orderByDesc('subscribed_at')
            ->paginate($perPage);
    }

    public function findByProvider(string $subscriberId, SubscriptionEnum $providerEnum): ?SubscriptionEntity
    {
        $subscription = Subscription::query()
            ->where('subscriber_id', $subscriberId)
            ->where('provider', $providerEnum->value)
            ->orderByDesc('subscribed_at')
            ->first();

        if (!$subscription) {
            return null;
        }

        return SubscriptionEntity::make($subscription->toArray());
    }
}
