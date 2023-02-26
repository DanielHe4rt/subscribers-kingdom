<?php

namespace Kingdom\Webhooks\Domain\Enums;

enum SubscriptionActionsEnum: string
{
    case CREATED = 'created';
    case CANCELLED = 'cancelled';


    public static function fromSubscriptionProvider(string $providerSubscriptionEvent): self
    {
        return match ($providerSubscriptionEvent) {
            'created', 'channel.subscribe', 'channel.subscription.gift', 'channel.subscription.message' => self::CREATED,
            'cancelled', 'channel.subscription.end' => self::CANCELLED,
        };
    }
}
