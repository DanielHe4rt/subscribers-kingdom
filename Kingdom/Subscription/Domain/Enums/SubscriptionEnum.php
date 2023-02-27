<?php

namespace Kingdom\Subscription\Domain\Enums;

use Kingdom\Subscription\Domain\Entities\SubscriptionEntity;

enum SubscriptionEnum: string
{
    case TWITCH = 'twitch';
    case GITHUB = 'github';

    public static function all(): array
    {
        return [
            'twitch' => self::TWITCH,
            'github' => self::GITHUB
        ];
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::TWITCH => 'fa-brands fa-twitch',
            self::GITHUB => 'fa-brands fa-github',
        };
    }

    public function alreadySubscriberText(SubscriptionEntity $entity): string
    {
        return 'Inscrição ativa.';
    }

    public function notSubscribed(): string
    {
        $subscriptionLink = match ($this) {
            self::TWITCH => 'https://www.twitch.tv/products/danielhe4rt',
            self::GITHUB => 'https://github.com/sponsors/danielhe4rt/',
        };

        return sprintf("Se inscreva <a href='%s'>clicando aqui. </a>", $subscriptionLink);
    }
}
