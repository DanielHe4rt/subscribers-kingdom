<?php

namespace Kingdom\Subscriber\Domain\DTO;

use Kingdom\Authentication\OAuth\Domain\DTO\OAuthUserDTO;

class SubscriberDTO
{
    public function __construct(
        public readonly string  $username,
        public readonly ?string $avatarUrl = null,
        public readonly ?string $emailProviderId = null,
        public readonly ?string $phoneNumber = null,
    )
    {
    }

    public static function makeFromOAuth(OAuthUserDTO $dto): self
    {
        return new self(
            username: $dto->username,
            avatarUrl: $dto->avatarUrl,
            emailProviderId: null,
            phoneNumber: null
        );
    }

    public function toDatabase(): array
    {
        return [
            'username' => $this->username,
            'email_id' => $this->emailProviderId,
            'phone_number' => $this->phoneNumber,
            'avatar_url' => $this->avatarUrl,
        ];
    }
}
