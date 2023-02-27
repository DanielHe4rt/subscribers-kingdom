<?php

namespace Kingdom\Subscription\Domain\Transformers;

use DateTime;

class TwitchSpreadsheetTransformer implements SubsSpreadsheetTransformerContract
{

    public function fromCSV(array $payload): array
    {
        return [
            'username' => $payload[1],
            'provider' => 'twitch',
            'subscribed_at' => $payload[0],
            'subscriber_id' => null
        ];
    }
}
