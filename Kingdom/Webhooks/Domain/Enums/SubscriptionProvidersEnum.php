<?php

namespace Kingdom\Webhooks\Domain\Enums;

use Kingdom\Webhooks\Domain\Transformers\GithubWebhookTransformer;
use Kingdom\Webhooks\Domain\Transformers\TwitchWebhookTransformer;
use Kingdom\Webhooks\Domain\Transformers\WebhookTransformerContract;

enum SubscriptionProvidersEnum: string
{
    case TWITCH = 'twitch';
    case GITHUB = 'github';

    public function getTransformer(): WebhookTransformerContract
    {
        return match ($this) {
            self::TWITCH => new TwitchWebhookTransformer,
            self::GITHUB => new GithubWebhookTransformer,
        };
    }
}
