<?php

namespace Kingdom\Authentication\OAuth\Infrastructure\Repositories;

use Kingdom\Authentication\OAuth\Domain\DTO\OAuthAccessDTO;
use Kingdom\Authentication\OAuth\Domain\Repositories\TokenRepository;
use Kingdom\Authentication\OAuth\Infrastructure\Models\Token;

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
