<?php

namespace Kingdom\Webhooks\Domain\DTOs;

use Kingdom\Webhooks\Domain\Enums\SubscriptionActionsEnum;
use Kingdom\Webhooks\Domain\Enums\SubscriptionProvidersEnum;

class SubscriptionWebhookDTO
{
    public function __construct(
        public readonly SubscriptionProvidersEnum $provider,
        public readonly SubscriptionActionsEnum   $action,
        public readonly string                    $status,
        public readonly string                    $providerId,
        public readonly string                    $providerLogin,
    )
    {
    }

    public static function make(array $payload): self
    {
        return new self(
            provider: SubscriptionProvidersEnum::from($payload['provider']),
            action: SubscriptionActionsEnum::fromSubscriptionProvider($payload['action']),
            status: $payload['status'],
            providerId: $payload['provider_id'],
            providerLogin: $payload['provider_login'],
        );
    }
}
