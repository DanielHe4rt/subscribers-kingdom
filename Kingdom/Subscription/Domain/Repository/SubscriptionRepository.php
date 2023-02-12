<?php

namespace Kingdom\Subscription\Domain\Repository;

use Kingdom\Subscriber\Infrastructure\Models\Subscriber;
use Kingdom\Subscription\Domain\DTO\NewSubscriberDTO;

interface SubscriptionRepository
{
    public function create(NewSubscriberDTO $newSubscriber): Subscriber;
}
