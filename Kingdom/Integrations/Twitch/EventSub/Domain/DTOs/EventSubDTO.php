<?php

namespace Kingdom\Integrations\Twitch\EventSub\Domain\DTOs;

use Kingdom\Integrations\Twitch\EventSub\Domain\Enums\EventSubTypesEnum;

class EventSubDTO implements \JsonSerializable
{
    public function __construct(
        private readonly EventSubTypesEnum $eventType,
        private readonly array $conditions,
        private readonly string $callbackUrl,
        private readonly int $version = 1,
    )
    {
    }

    public function jsonSerialize(): array
    {
        return [
            "type" => $this->eventType->value,
            "version" => $this->version,
            "condition" => $this->conditions,
            "transport" => [
                "method" => "webhook",
                "callback" => $this->callbackUrl,
                "secret" => 'fodase123vaicaralho'
            ]
        ];
    }
}
