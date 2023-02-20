<?php

namespace Kingdom\Integrations\Github\OAuth\Domain\DTOs;

use Kingdom\Authentication\OAuth\Domain\DTO\OAuthAccessDTO;

class GithubOAuthAccessDTO extends OAuthAccessDTO
{

    public static function make(array $payload): OAuthAccessDTO
    {
        return new self(
            $payload['access_token'],
            $payload['refresh_token'],
            $payload['expires_in'] ?? ''
        );
    }
}
