<?php

namespace Kingdom\Landing;

use Kingdom\Core\Contracts\DomainInterface;
use Kingdom\Landing\Infrastructure\Provider\LandingRouteProvider;
use Kingdom\Landing\Infrastructure\Provider\LandingServiceProvider;

class LandingDomain extends DomainInterface
{

    public function registerProvider(): array
    {
        return [
            LandingServiceProvider::class,
            LandingRouteProvider::class
        ];
    }
}
