<?php

namespace Kingdom\Webhooks\Application;

use Kingdom\Subscription\Application\NewSubscription;
use Kingdom\Subscription\Domain\DTO\NewSubscriberDTO;
use Kingdom\Webhooks\Domain\Enums\SubscriptionProvidersEnum;

class SubscriptionWebhook
{
    public function __construct(private readonly NewSubscription $newSubscription)
    {
    }

    public function byProvider(SubscriptionProvidersEnum $provider, array $payload)
    {
        $subscriptionWebhookDTO = $provider->getTransformer()->toDTO($payload);

        $this->newSubscription->persist(new NewSubscriberDTO(
            $subscriptionWebhookDTO->providerLogin,
            $subscriptionWebhookDTO->subscriptionProvider->value,
            now()->toDateTime(),
        ));
    }
}
