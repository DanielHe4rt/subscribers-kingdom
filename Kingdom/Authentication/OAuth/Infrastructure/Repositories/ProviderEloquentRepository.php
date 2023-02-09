<?php

namespace Kingdom\Authentication\OAuth\Infrastructure\Repositories;

use Kingdom\Authentication\OAuth\Domain\DTO\OAuthUserDTO;
use Kingdom\Authentication\OAuth\Domain\Repositories\ProviderRepository;
use Kingdom\Authentication\OAuth\Infrastructure\Models\Provider;

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

    public function findByProviderId(string $providerId): ?Provider
    {
        return Provider::find($providerId);
    }
}
