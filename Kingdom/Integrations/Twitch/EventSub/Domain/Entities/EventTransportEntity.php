<?php

namespace Kingdom\Integrations\Twitch\EventSub\Domain\Entities;

class EventTransportEntity
{
    public function __construct(
        public string  $method,
        private string $callbackUrl,
    )
    {
    }

    public static function make(array $payload): self
    {
        return new self(
            $payload['method'],
            $payload['callback']
        );
    }

    public function getCallbackUrl(): string
    {
        return $this->callbackUrl;
    }
}
