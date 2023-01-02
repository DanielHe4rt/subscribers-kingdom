<?php

namespace Kingdom\Integrations\Shared\DTO;

abstract class OAuthUserDTO
{
    public function __construct(
        public string  $id,
        public string  $username,
        public string  $name,
        public ?string $email,
        public ?string $avatarUrl,
    )
    {
    }

    public abstract static function make(array $payload): self;
}
