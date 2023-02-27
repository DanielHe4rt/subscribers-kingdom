<?php

namespace Kingdom\Subscription\Application;

use Kingdom\Subscription\Domain\DTO\NewSubscriberDTO;
use Kingdom\Subscription\Domain\Repository\SubscriptionRepository;
use Kingdom\Webhooks\Domain\DTOs\SubscriptionWebhookDTO;

class NewSubscription
{
    public function __construct(private readonly SubscriptionRepository $subscriptionRepository)
    {
    }

    public function persist(NewSubscriberDTO $DTO): void
    {
        $this->subscriptionRepository->create($DTO);
    }
}
