<?php

namespace Kingdom\Authentication\Infrastructure\Repositories;

use Kingdom\Authentication\Domain\Repositories\ProviderRepository;
use Kingdom\Authentication\Infrastructure\Models\Provider;
use Kingdom\Integrations\Shared\DTO\OAuthUserDTO;
use Kingdom\Integrations\Shared\Enums\OAuthProviderEnum;

class ProviderEloquentRepository implements ProviderRepository
{

    public function findByProvider(OAuthUserDTO $user): ?Provider
    {
        return Provider::where('provider', $user->providerName)
            ->where('provider_id', $user->providerId)
            ->first();
    }

    public function create(string $subscriberId, OAuthUserDTO $user): Provider
    {
        return Provider::create([
            'subscriber_id' => $subscriberId,
            ...$user->toDatabase()
        ]);
    }
}
