<?php

namespace Kingdom\Webhooks\Domain\Transformers;

use Kingdom\Webhooks\Domain\DTOs\SubscriptionWebhookDTO;

class GithubWebhookTransformer implements WebhookTransformerContract
{
    public function toDTO(array $payload): SubscriptionWebhookDTO
    {

        $transformedPayload = $this->transformPayload($payload);

        return SubscriptionWebhookDTO::make($transformedPayload);
    }

    private function transformPayload(array $payload): array
    {
        return [
            'status' => $payload['sender']['status'],
            'type' => $payload['action'] ?? '',
            'provider' => 'github',
            'provider_id' => $payload['sender']['id'],
            'provider_login' => $payload['sender']['login']
        ];
    }
}
