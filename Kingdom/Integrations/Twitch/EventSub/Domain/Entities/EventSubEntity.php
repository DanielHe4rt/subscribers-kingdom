<?php

namespace Kingdom\Integrations\Twitch\EventSub\Domain\Entities;

use DateTime;
use Kingdom\Integrations\Twitch\EventSub\Domain\Enums\EventStatusEnum;
use Kingdom\Integrations\Twitch\EventSub\Domain\Enums\EventSubTypesEnum;

class EventSubEntity
{
    public function __construct(
        public string                        $id,
        public EventStatusEnum               $status,
        public readonly EventSubTypesEnum    $typesEnum,
        public readonly int                  $version,
        public readonly array                $conditions,
        public readonly EventTransportEntity $transport,
        public readonly DateTime             $createdAt,
    )
    {
    }

    public static function make(array $payload): self
    {
        return new self(
            id: $payload['id'],
            status: EventStatusEnum::from($payload['status']),
            typesEnum: EventSubTypesEnum::from($payload['type']),
            version: $payload['version'],
            conditions: $payload['condition'],
            transport: EventTransportEntity::make($payload['transport']),
            createdAt: new DateTime($payload['created_at'])
        );
    }
}
