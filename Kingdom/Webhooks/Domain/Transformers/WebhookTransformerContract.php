<?php

namespace Kingdom\Webhooks\Domain\Transformers;

use Kingdom\Webhooks\Domain\DTOs\SubscriptionWebhookDTO;

interface WebhookTransformerContract
{
    public function toDTO(array $payload): SubscriptionWebhookDTO;
}
