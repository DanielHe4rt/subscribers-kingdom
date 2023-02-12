<?php

namespace Kingdom\Subscription\Application;

use Kingdom\Subscription\Domain\DTO\NewSubscriberDTO;
use Kingdom\Subscription\Domain\Repository\SubscriptionRepository;

class ImportSubscribers
{
    public function __construct(
        private readonly SubscriptionRepository $subscriptionRepository
    )
    {
    }

    public function fromCSV(): void
    {
        $subscribersListPath = storage_path('app/subscribers.csv');
        $subscribersList = fopen($subscribersListPath, 'r');

        $headers = true;

        while ($row = fgetcsv($subscribersList, 1000)) {
            if ($headers) {
                $headers = false;
                continue;
            }
            $this->subscriptionRepository->create(
                NewSubscriberDTO::makeFromCSV('twitch', $row)
            );
        }
    }
}
