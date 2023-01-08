<?php

namespace Kingdom\Profile;

use Kingdom\Core\Contracts\DomainInterface;
use Kingdom\Profile\Infrastructure\Providers\ProfileRouteProvider;
use Kingdom\Profile\Infrastructure\Providers\ProfileServiceProvider;

class ProfileDomain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            ProfileServiceProvider::class,
            ProfileRouteProvider::class
        ];
    }
}
