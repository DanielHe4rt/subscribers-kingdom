<?php

namespace Kingdom\Subscriber\Domain\DTO;

class SubscriberDTO
{
    public function __construct(
        public readonly string  $username,
        public readonly ?string $emailProviderId = null,
        public readonly ?string $phoneNumber = null
    )
    {
    }

    public function toDatabase(): array
    {
        return [
            'username' => $this->username,
            'email_id' => $this->emailProviderId,
            'phone_number' => $this->phoneNumber
        ];
    }
}
