<?php

namespace Kingdom\Webhooks\Application;

use Illuminate\Support\Facades\Log;
use Kingdom\Subscription\Application\NewSubscription;
use Kingdom\Subscription\Domain\DTO\NewSubscriberDTO;
use Kingdom\Webhooks\Domain\DTOs\SubscriptionWebhookDTO;
use Kingdom\Webhooks\Domain\Enums\SubscriptionActionsEnum;
use Kingdom\Webhooks\Domain\Enums\SubscriptionProvidersEnum;

class SubscriptionWebhook
{
    public function __construct(private readonly NewSubscription $newSubscription)
    {
    }

    public function byProvider(SubscriptionProvidersEnum $provider, array $payload): void
    {
        $subscriptionWebhookDTO = $provider->getTransformer()->toDTO($payload);

        match($subscriptionWebhookDTO->action) {
            SubscriptionActionsEnum::CREATED => $this->handleNewSubscription($subscriptionWebhookDTO),
            SubscriptionActionsEnum::CANCELLED => $this->handleCancelledSubscription($subscriptionWebhookDTO)
        };

    }

    private function handleNewSubscription(SubscriptionWebhookDTO $subscriptionWebhookDTO): void
    {
        $subscriptionMessage = sprintf(
            '%s subscribed at %s!',
            $subscriptionWebhookDTO->providerLogin,
            $subscriptionWebhookDTO->provider->value
        );
        Log::channel('discord')->alert('[Subscriptions Alert] ' . $subscriptionMessage, [
            'content' => request()->all()
        ]);

        $this->newSubscription->persist(new NewSubscriberDTO(
            $subscriptionWebhookDTO->providerLogin,
            $subscriptionWebhookDTO->provider->value,
            now()->toDateTime(),
        ));

        // TODO: post on twitter if from github elon musk troxão
    }

    private function handleCancelledSubscription(SubscriptionWebhookDTO $subscriptionWebhookDTO): void
    {

    }
}
