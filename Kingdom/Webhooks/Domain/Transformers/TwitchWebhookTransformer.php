<?php

namespace Kingdom\Webhooks\Domain\Transformers;

use Kingdom\Webhooks\Domain\DTOs\SubscriptionWebhookDTO;

class TwitchWebhookTransformer implements WebhookTransformerContract
{

    public function toDTO(array $payload): SubscriptionWebhookDTO
    {

        $transformedPayload = $this->transformPayload($payload);

        return SubscriptionWebhookDTO::make($transformedPayload);
    }

    private function transformPayload(array $payload): array
    {
        return [
            'status' => $payload['subscription']['status'],
            'action' => $payload['subscription']['type'],
            'provider' => 'twitch',
            'provider_id' => $payload['event']['user_id'],
            'provider_login' => $payload['event']['user_login']
        ];
    }
}
