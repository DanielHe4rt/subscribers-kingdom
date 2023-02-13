<?php

namespace Kingdom\Integrations\Twitch\EventSub\Domain\Enums;

enum EventSubTypesEnum: string
{
    case RE_SUBSCRIPTION = 'channel.subscription.message';
    case NEW_SUBSCRIPTION = 'channel.subscribe';
    case SUBSCRIPTION_ENDED = 'channel.subscription.end';
    case STREAM_ONLINE = 'stream.online';
    case STREAM_OFFLINE = 'stream.offline';

    public function eventSubUri(): string
    {
        return match ($this) {
            self::RE_SUBSCRIPTION => 'resub',
            self::NEW_SUBSCRIPTION => 'sub',
            self::SUBSCRIPTION_ENDED => 'subEnded',
            self::STREAM_ONLINE => 'online',
            self::STREAM_OFFLINE => 'offline',
        };
    }

    public static function fromUri(string $uri): self
    {
        return match ($uri) {
            'resub' => self::RE_SUBSCRIPTION,
            'sub' => self::NEW_SUBSCRIPTION,
            'subEnded' => self::SUBSCRIPTION_ENDED,
            'online' => self::STREAM_ONLINE,
            'offline' => self::STREAM_OFFLINE,
        };
    }
}
