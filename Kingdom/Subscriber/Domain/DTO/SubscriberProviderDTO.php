<?php

namespace Kingdom\Subscriber\Domain\DTO;

class SubscriberProviderDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $subscriberId,
        public readonly string $providerName,
        public readonly string $providerId,
        public readonly ?string $email
    )
    {
    }

    public static function make(array $payload): self
    {
        return new self(
            id: $payload['id'],
            subscriberId: $payload['subscriber_id'],
            providerName: $payload['provider'],
            providerId: $payload['provider_id'],
            email: $payload['email'] ?? ''
        );
    }
}
