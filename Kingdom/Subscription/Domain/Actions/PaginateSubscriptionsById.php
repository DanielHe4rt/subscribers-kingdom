<?php

namespace Kingdom\Subscription\Domain\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Kingdom\Subscription\Domain\Repository\SubscriptionRepository;

class PaginateSubscriptionsById
{
    public function __construct(
        private readonly SubscriptionRepository $subscriptionRepository
    )
    {
    }

    public function paginate(string $subscriberId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->subscriptionRepository->paginate($subscriberId, $perPage);
    }
}
