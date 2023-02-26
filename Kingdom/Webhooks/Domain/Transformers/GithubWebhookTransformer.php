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
            'action' => $payload['payload']['action'],
            'provider' => 'github',
            'provider_id' => $payload['payload']['sender']['id'],
            'provider_login' => $payload['payload']['sender']['login']
        ];
    }
}
