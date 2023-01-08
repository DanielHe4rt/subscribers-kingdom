<?php

namespace Kingdom\Authentication\Domain\Repositories;

use Kingdom\Authentication\Infrastructure\Models\Token;
use Kingdom\Integrations\Shared\DTO\OAuthAccessDTO;

interface TokenRepository
{
    public function create(string $providerId, OAuthAccessDTO $credentials): Token;
}
