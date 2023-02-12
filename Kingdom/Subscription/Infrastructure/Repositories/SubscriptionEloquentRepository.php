<?php

namespace Kingdom\Subscription\Infrastructure\Repositories;

use Kingdom\Subscriber\Infrastructure\Models\Subscriber;
use Kingdom\Subscription\Domain\DTO\NewSubscriberDTO;
use Kingdom\Subscription\Domain\Repository\SubscriptionRepository;

class SubscriptionEloquentRepository implements SubscriptionRepository
{
    public function create(NewSubscriberDTO $newSubscriber): Subscriber
    {
        return Subscriber::create($newSubscriber->toDatabase());
    }
}
