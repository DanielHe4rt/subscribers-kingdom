<?php

namespace Kingdom\Subscription\Domain\Transformers;

use DateTime;

class GithubSpreadsheetTransformer implements SubsSpreadsheetTransformerContract
{
    public function fromCSV(array $payload): array
    {
        return [
            'username' => $payload[0],
            'provider' => 'github',
            'subscribed_at' => $payload[3],
            'subscriber_id' => null
        ];
    }
}
