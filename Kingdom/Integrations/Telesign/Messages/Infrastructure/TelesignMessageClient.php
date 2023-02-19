<?php

namespace Kingdom\Integrations\Telesign\Messages\Infrastructure;

use GuzzleHttp\Client;
use Kingdom\Shared\Domain\Contracts\MessageContract;

class TelesignMessageClient implements MessageContract
{
    public function __construct(private readonly Client $client)
    {
    }

    public function sendSMS(string $to, string $message): array
    {

        $uri = 'v1/messaging';
        $to = str_replace('+', '', $to);
        $payload = [
            'phone_number' => $to,
            'message' => $message,
            'message_type' => 'ARN' // ?? enumzada
        ];

        $response = $this->client->post($uri, [
            'form_params' => $payload
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
