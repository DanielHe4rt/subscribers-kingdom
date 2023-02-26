<?php

namespace Kingdom\Webhooks\Domain\Transformers;

use Kingdom\Webhooks\Domain\DTOs\SubscriptionWebhookDTO;

class GithubWebhookTransformer implements WebhookTransformerContract
{
    public function toDTO(array $payload): SubscriptionWebhookDTO
    {

    }
}
