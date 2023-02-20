<?php

namespace Kingdom\Integrations\Github\OAuth\Domain\DTOs;


use Kingdom\Authentication\OAuth\Domain\DTO\OAuthAccessDTO;
use Kingdom\Authentication\OAuth\Domain\DTO\OAuthUserDTO;

class GithubUserDTO extends OAuthUserDTO
{
    public static function make(OAuthAccessDTO $credentials, array $payload): OAuthUserDTO
    {
        return new self(
            credentials: $credentials,
            providerId: $payload['id'],
            providerName: 'github',
            username: $payload['login'],
            name: $payload['name'],
            email: $payload['email'] ?? null,
            avatarUrl: sprintf('https://github.com/%s.png', $payload['login'])
        );
    }
}
