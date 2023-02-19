<?php

namespace Kingdom\Integrations\Telesign\Common;

use Kingdom\Integrations\Telesign\Messages\Infrastructure\TelesignMessageClient;

interface TelesignService
{
    public function messages(): TelesignMessageClient;
}
