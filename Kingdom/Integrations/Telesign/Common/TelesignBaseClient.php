<?php

namespace Kingdom\Integrations\Telesign\Common;

use GuzzleHttp\Client;
use Kingdom\Integrations\Telesign\Messages\Infrastructure\TelesignMessageClient;

class TelesignBaseClient implements TelesignService
{
    public function __construct(private readonly Client $client)
    {
    }


    public function messages(): TelesignMessageClient
    {
        return new TelesignMessageClient($this->client);
    }
}
