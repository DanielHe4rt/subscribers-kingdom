<?php

namespace Kingdom\Webhooks\Application;

use Illuminate\Support\Facades\Cache;
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

        if ($this->alreadyRegisteredWebhook($subscriptionWebhookDTO)) {
            return;
        }

        match ($subscriptionWebhookDTO->action) {
            SubscriptionActionsEnum::CREATED => $this->handleNewSubscription($subscriptionWebhookDTO),
            SubscriptionActionsEnum::CANCELLED => $this->handleCancelledSubscription($subscriptionWebhookDTO)
        };

    }

    private function handleNewSubscription(SubscriptionWebhookDTO $subscriptionDTO): void
    {
        $this->dispatchLog($subscriptionDTO);

        $this->newSubscription->persist(new NewSubscriberDTO(
            $subscriptionDTO->providerLogin,
            $subscriptionDTO->provider->value,
            now()->toDateTime(),
        ));

        $cacheKey = $this->getCacheKey($subscriptionDTO);
        Cache::tags(['webhooks'])->remember($cacheKey, 10, fn() => true);

        // TODO: post on twitter if from github elon musk troxão
    }

    private function handleCancelledSubscription(SubscriptionWebhookDTO $subscriptionWebhookDTO): void
    {

    }

    private function alreadyRegisteredWebhook(SubscriptionWebhookDTO $subscriptionDTO): bool
    {
        $cacheKey = $this->getCacheKey($subscriptionDTO);

        return Cache::tags(['webhooks'])->has($cacheKey);
    }

    /**
     * @param \Kingdom\Webhooks\Domain\DTOs\SubscriptionWebhookDTO $subscriptionWebhookDTO
     * @return void
     */
    public function dispatchLog(SubscriptionWebhookDTO $subscriptionWebhookDTO): void
    {
        Log::channel('discord')->alert('[Subscriptions Alert] ' . sprintf(
                '%s subscribed at %s!',
                $subscriptionWebhookDTO->providerLogin,
                $subscriptionWebhookDTO->provider->value
            ), [
            'content' => request()->all()
        ]);
    }

    /**
     * @param \Kingdom\Webhooks\Domain\DTOs\SubscriptionWebhookDTO $subscriptionDTO
     * @return string
     */
    public function getCacheKey(SubscriptionWebhookDTO $subscriptionDTO): string
    {
        $cacheKey = sprintf(
            '%s-%s-%s',
            $subscriptionDTO->provider->value,
            $subscriptionDTO->providerLogin,
            $subscriptionDTO->action->value
        );
        return $cacheKey;
    }
}
