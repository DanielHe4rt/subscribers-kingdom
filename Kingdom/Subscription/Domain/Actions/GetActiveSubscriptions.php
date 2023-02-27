<?php

namespace Kingdom\Subscription\Domain\Actions;

use Kingdom\Integrations\Twitch\Subscriber\Domain\DTO\TwitchSubscriberDTO;
use Kingdom\Subscriber\Domain\Repositories\SubscribersRepository;
use Kingdom\Subscription\Domain\Collections\SubscriptionsCollection;
use Kingdom\Subscription\Domain\Enums\SubscriptionEnum;
use Kingdom\Subscription\Domain\Repository\SubscriptionRepository;

class GetActiveSubscriptions
{
    public function __construct(
        private readonly SubscribersRepository  $subscribersRepository,
        private readonly SubscriptionRepository $subscriptionRepository
    )
    {
    }

    public function handle(string $subscriberId): array
    {
        $subscriber = $this->subscribersRepository->findById($subscriberId);

        $arrayFoda = [];
        foreach (SubscriptionEnum::all() as $subscriptionEnum) {
            $entity = $this->subscriptionRepository->findByProvider($subscriber->id, $subscriptionEnum);

            $arrayFoda[] = ['enum' => $subscriptionEnum, 'entity' => $entity];
        }

        return $arrayFoda;
    }
}
