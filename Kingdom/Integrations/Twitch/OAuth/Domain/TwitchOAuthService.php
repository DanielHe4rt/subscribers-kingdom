<?php

namespace Kingdom\Integrations\Twitch\OAuth\Domain;

use Kingdom\Authentication\OAuth\Domain\DTO\OAuthAccessDTO;
use Kingdom\Authentication\OAuth\Domain\Interfaces\OAuthClientContract;

interface TwitchOAuthService extends OAuthClientContract
{
    public function authApp(): OAuthAccessDTO;
}
