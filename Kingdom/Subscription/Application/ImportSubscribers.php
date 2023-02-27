<?php

namespace Kingdom\Subscription\Application;

use Generator;
use Kingdom\Subscription\Domain\DTO\NewSubscriberDTO;
use Kingdom\Subscription\Domain\Enums\SubscriptionSpreadsheetsEnum;
use Kingdom\Subscription\Domain\Repository\SubscriptionRepository;

class ImportSubscribers
{
    public function __construct(
        private readonly SubscriptionRepository $subscriptionRepository
    )
    {
    }

    public function fromCSV(array $subscriptionsList, \Closure $closure): void
    {
        foreach ($subscriptionsList as $list) {
            [$spreadsheetEnum, $spreadsheetUrl] = $list;

            foreach ($this->subscriptionsList($spreadsheetEnum, $spreadsheetUrl) as $row) {
                $subscriberDTO = NewSubscriberDTO::makeFromCSV($row);

                $this->subscriptionRepository->create($subscriberDTO);
                $closure($subscriberDTO);
            }
        }
    }


    public function subscriptionsList(SubscriptionSpreadsheetsEnum $enum, string $url): Generator
    {
        $subscribersList = fopen($url, 'r');
        $headers = true;
        while ($row = fgetcsv($subscribersList, 1000)) {
            if ($headers) {
                $headers = false;
                continue;
            }
            yield $enum->transformer()->fromCSV($row);
        }

        fclose($subscribersList);
    }
}
