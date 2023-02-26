<?php

namespace Kingdom\Webhooks\Domain\DTOs;

use Kingdom\Webhooks\Domain\Enums\SubscriptionProvidersEnum;

class SubscriptionWebhookDTO
{
    public function __construct(
        public readonly SubscriptionProvidersEnum $subscriptionProvider,
        public readonly string                    $webhookType,
        public readonly string                    $status,
        public readonly string                    $providerId,
        public readonly string                    $providerLogin,
    )
    {
    }

    public static function make(array $payload): self
    {
        return new self(
            subscriptionProvider: SubscriptionProvidersEnum::from($payload['provider']),
            webhookType: $payload['type'],
            status: $payload['status'],
            providerId: $payload['provider_id'],
            providerLogin: $payload['provider_login'],
        );
    }
}
