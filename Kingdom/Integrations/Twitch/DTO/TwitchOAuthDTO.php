<?php

namespace Kingdom\Integrations\Twitch\DTO;

use Kingdom\Integrations\Shared\DTO\OAuthAccessDTO;
use Kingdom\Integrations\Shared\DTO\OAuthUserDTO;

class TwitchOAuthDTO extends OAuthUserDTO
{
    public static function make(OAuthAccessDTO $credentials, array $payload): OAuthUserDTO
    {
        $user = $payload['data'][0];
        return new self(
            credentials: $credentials,
            providerId: $user['id'],
            providerName: 'twitch',
            username: $user['login'],
            name: $user['display_name'],
            email: $user['email'],
            avatarUrl: $user['profile_image_url']
        );
    }
}
