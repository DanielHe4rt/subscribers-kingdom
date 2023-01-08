<?php

namespace Kingdom\Authentication\Domain\Repositories;

use Kingdom\Authentication\Infrastructure\Models\Provider;
use Kingdom\Integrations\Shared\DTO\OAuthUserDTO;
use Kingdom\Integrations\Shared\Enums\OAuthProviderEnum;

interface ProviderRepository
{
    public function findByProvider(OAuthUserDTO $user): ?Provider;

    public function create(string $subscriberId, OAuthUserDTO $dto): Provider;
}
