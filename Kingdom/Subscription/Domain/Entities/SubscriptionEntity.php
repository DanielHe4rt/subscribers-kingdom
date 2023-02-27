<?php

namespace Kingdom\Subscription\Domain\Entities;

use DateTime;
use Kingdom\Subscription\Domain\Enums\SubscriptionEnum;

class SubscriptionEntity
{
    public function __construct(
        public int              $id,
        public string           $username,
        public SubscriptionEnum $provider,
        public DateTime         $subscribedAt,
        public ?string          $subscriberId = null,
    )
    {
    }

    public static function make(array $payload): self
    {
        return new self(
            id: $payload['id'],
            username: $payload['username'],
            provider: SubscriptionEnum::from($payload['provider']),
            subscribedAt: new DateTime($payload['subscribed_at']),
            subscriberId: $payload['subscriber_id']
        );
    }
}
