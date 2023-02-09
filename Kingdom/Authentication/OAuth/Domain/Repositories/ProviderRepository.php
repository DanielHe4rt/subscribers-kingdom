<?php

namespace Kingdom\Authentication\OAuth\Domain\Repositories;

use Kingdom\Authentication\OAuth\Domain\DTO\OAuthUserDTO;
use Kingdom\Authentication\OAuth\Infrastructure\Models\Provider;

interface ProviderRepository
{
    public function findByProvider(OAuthUserDTO $user): ?Provider;

    public function findByProviderId(string $providerId): ?Provider;

    public function create(string $subscriberId, OAuthUserDTO $user): Provider;
}
