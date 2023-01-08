<?php

namespace Kingdom\Authentication\Infrastructure\Repositories;

use Kingdom\Authentication\Domain\Repositories\TokenRepository;
use Kingdom\Authentication\Infrastructure\Models\Token;
use Kingdom\Integrations\Shared\DTO\OAuthAccessDTO;

class TokenEloquentRepository implements TokenRepository
{
    public function create(string $providerId, OAuthAccessDTO $credentials): Token
    {
        return Token::create([
            'provider_id' => $providerId,
            ...$credentials->toDatabase()
        ]);
    }
}
