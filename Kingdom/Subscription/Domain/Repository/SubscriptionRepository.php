<?php

namespace Kingdom\Subscription\Domain\Repository;

use Illuminate\Pagination\LengthAwarePaginator;
use Kingdom\Subscriber\Infrastructure\Models\Subscriber;
use Kingdom\Subscription\Domain\DTO\NewSubscriberDTO;
use Kingdom\Subscription\Infrastructure\Models\Subscription;

interface SubscriptionRepository
{
    public function create(NewSubscriberDTO $newSubscriber): Subscription;

    public function paginate(string $subscriberId, int $perPage = 15): LengthAwarePaginator;
}
