<?php

namespace Kingdom\Integrations\Twitch\DTO;

use Kingdom\Integrations\Shared\DTO\OAuthAccessDTO;

class TwitchOAuthAccessDTO extends OAuthAccessDTO
{

    public static function make(array $payload): self
    {
        return new self(
            accessToken: $payload['access_token'],
            refreshToken: $payload['refresh_token'],
            expiresIn: $payload['expires_in']
        );
    }
}
