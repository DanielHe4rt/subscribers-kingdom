<?php

namespace Kingdom\Subscription\Domain\Enums;

use Kingdom\Subscription\Domain\Transformers\GithubSpreadsheetTransformer;
use Kingdom\Subscription\Domain\Transformers\SubsSpreadsheetTransformerContract;
use Kingdom\Subscription\Domain\Transformers\TwitchSpreadsheetTransformer;

enum SubscriptionSpreadsheetsEnum: string
{
    case TWITCH = 'twitch';
    case GITHUB = 'github';


    public static function all(): array
    {
        return [
            self::GITHUB,
            self::TWITCH
        ];
    }

    public function transformer(): SubsSpreadsheetTransformerContract
    {
        return match ($this) {
            self::TWITCH => new TwitchSpreadsheetTransformer(),
            self::GITHUB => new GithubSpreadsheetTransformer(),
        };
    }
}
