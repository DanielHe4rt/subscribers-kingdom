<?php

namespace Kingdom\Webhooks\Domain\Transformers;

use Illuminate\Support\Facades\Log;
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
        Log::alert('fudeu', $payload);
        return [
            'status' => '',
            'action' => $payload['action'],
            'provider' => 'github',
            'provider_id' => $payload['sender']['id'],
            'provider_login' => $payload['sender']['login']
        ];
    }
}
