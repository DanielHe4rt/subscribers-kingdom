<?php

namespace Kingdom\Profile;

use Kingdom\Core\Contracts\DomainInterface;
use Kingdom\Profile\Infrastructure\Providers\ProfileRouteProvider;

class ProfileDomain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            ProfileRouteProvider::class
        ];
    }
}
