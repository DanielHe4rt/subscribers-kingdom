<?php

namespace Kingdom\Integrations\Twilio\Common;

use GuzzleHttp\Client;
use Kingdom\Integrations\Twilio\Messages\Infrastructure\TwilioMessageClient;

class TwilioBaseClient implements TwilioService
{
    public function __construct(private readonly Client $client)
    {
    }

    public function messages(): TwilioMessageClient
    {
        return new TwilioMessageClient($this->client);
    }
}
