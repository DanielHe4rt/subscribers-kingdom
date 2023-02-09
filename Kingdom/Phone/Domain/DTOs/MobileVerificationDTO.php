<?php

namespace Kingdom\Phone\Domain\DTOs;

use Kingdom\Subscriber\Infrastructure\Models\Subscriber;

class MobileVerificationDTO
{
    public function __construct(
        public readonly Subscriber $subscriber,
        public readonly string     $phoneNumber,
    )
    {
    }

    public static function make(Subscriber $subscriber, string $phoneNumber): self
    {
        return new self($subscriber, $phoneNumber);
    }

}
