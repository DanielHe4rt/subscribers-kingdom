<?php

namespace Kingdom\Integrations\Twitch\OAuth\Domain\DTO;

use Kingdom\Authentication\OAuth\Domain\DTO\OAuthAccessDTO;
use Kingdom\Authentication\OAuth\Domain\DTO\OAuthUserDTO;

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
