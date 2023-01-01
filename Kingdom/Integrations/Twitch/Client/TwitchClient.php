<?php

namespace Kingdom\Integrations\Twitch\Client;

use GuzzleHttp\Client;
use Kingdom\Integrations\Shared\Domain\DTO\OAuthUserDTO;
use Kingdom\Integrations\Shared\Domain\Interfaces\OAuthContract;
use Kingdom\Integrations\Twitch\DTO\TwitchOAuthDTO;

class TwitchClient implements OAuthContract
{

    public function __construct(private readonly Client $client)
    {
    }

    public static function redirectUrl(): string
    {
        return sprintf(
            'https://id.twitch.tv/oauth2/authorize?client_id=%s&redirect_uri=%s&response_type=code&scope=%s',
            config('kingdom.integrations.twitch.client_id'),
            config('kingdom.integrations.twitch.redirect_uri'),
            config('kingdom.integrations.twitch.scopes')
        );
    }

    public function auth(string $code)
    {
        $uri = "https://id.twitch.tv/oauth2/token";
        $response = $this->client->request('POST', $uri, [
            'form_params' => [
                'client_id' => config('kingdom.integrations.twitch.client_id'),
                'client_secret' => config('kingdom.integrations.twitch.client_secret'),
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => config('kingdom.integrations.twitch.redirect_uri')
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getAuthenticatedUser(string $accessToken): OAuthUserDTO
    {
        $uri = "https://api.twitch.tv/helix/users";
        $response = $this->client->request('GET', $uri, [
            'headers' => [
                'Client-ID' => config('kingdom.integrations.twitch.client_id'),
                'Authorization' => 'OAuth ' . $accessToken,
                'Accept' => 'application/vnd.twitchtv.v5+json'
            ]
        ]);

        $payload = json_decode($response->getBody()->getContents(), true);
        return TwitchOAuthDTO::make($payload);
    }
}
