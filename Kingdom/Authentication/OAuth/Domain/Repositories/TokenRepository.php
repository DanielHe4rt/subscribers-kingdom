<?php

namespace Kingdom\Authentication\OAuth\Domain\Repositories;

use Kingdom\Authentication\OAuth\Domain\DTO\OAuthAccessDTO;
use Kingdom\Authentication\OAuth\Infrastructure\Models\Token;

interface TokenRepository
{
    public function create(string $providerId, OAuthAccessDTO $credentials): Token;
}
