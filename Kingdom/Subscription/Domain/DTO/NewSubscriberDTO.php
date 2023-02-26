<?php

namespace Kingdom\Subscription\Domain\DTO;

use DateTime;

class NewSubscriberDTO
{
    public function __construct(
        public readonly string   $username,
        public readonly string   $provider,
        public readonly DateTime $subscribedAt,
        public readonly ?string  $subscriberId = null,
    )
    {
    }

    public static function makeFromCSV(string $provider, array $payload): self
    {
        return new self(
            username: $payload[1],
            provider: $provider,
            subscribedAt: new DateTime($payload[0]),
            subscriberId: null,
        );
    }

    public function toDatabase()
    {
        return [
            'username' => $this->username,
            'provider' => $this->provider,
            'subscribed_at' => $this->subscribedAt,
            'subscriber_id' => $this->subscriberId ?? null,
        ];
    }
}
