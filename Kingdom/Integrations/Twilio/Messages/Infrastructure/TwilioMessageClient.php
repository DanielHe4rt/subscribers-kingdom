<?php

namespace Kingdom\Integrations\Twilio\Messages\Infrastructure;

use GuzzleHttp\Client;

class TwilioMessageClient
{
    public function __construct(private readonly Client $client)
    {

    }

    public function sendMessage(string $to, string $message)
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
