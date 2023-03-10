<?php

namespace Kingdom\Integrations\Twilio\Messages\Infrastructure;

use GuzzleHttp\Client;
use Kingdom\Shared\Domain\Contracts\MessageContract;

class TwilioMessageClient implements MessageContract
{
    public function __construct(private readonly Client $client)
    {

    }

    public function sendSMS(string $to, string $message): array
    {
        $uri = 'Messages.json';
        $payload = [
            'To' => 'whatsapp:' . $to,
            'From' => 'whatsapp:' . config('kingdom.integrations.twilio.sender_phone'),
            'Body' => $message
        ];

        $response = $this->client->post($uri, [
            'form_params' => $payload
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
