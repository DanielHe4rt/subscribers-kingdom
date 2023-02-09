<?php

namespace Kingdom\Integrations\Twitch\Subscriber\Domain\Enum;

enum SubscriptionTiersEnum: string
{
    case Tier_1 = '1000';
    case Tier_2 = '2000';
    case Tier_3 = '3000';

    public function friendlyTiers(): string
    {
        return match ($this) {
            self::Tier_1 => 'Membro (Tier 1)',
            self::Tier_2 => 'Culto (Tier 2)',
            self::Tier_3 => 'Monstro sagrado (Tier 3)',
        };
    }
}
