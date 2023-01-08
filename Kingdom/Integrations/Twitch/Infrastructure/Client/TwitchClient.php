<?php

namespace Kingdom\Integrations\Twitch\Infrastructure\Client;

use GuzzleHttp\Client;
use Kingdom\Authentication\OAuth\Domain\DTO\OAuthAccessDTO;
use Kingdom\Authentication\OAuth\Domain\DTO\OAuthUserDTO;
use Kingdom\Authentication\OAuth\Domain\Interfaces\OAuthClientContract;
use Kingdom\Integrations\Twitch\Domain\DTO\TwitchOAuthAccessDTO;
use Kingdom\Integrations\Twitch\Domain\DTO\TwitchOAuthDTO;

class TwitchClient implements OAuthClientContract
{

    public function __construct(private readonly Client $client)
    {
    }

    public function redirectUrl(): string
    {
        return sprintf(
            'https://id.twitch.tv/oauth2/authorize?client_id=%s&redirect_uri=%s&response_type=code&scope=%s',
            config('kingdom.integrations.twitch.client_id'),
            config('kingdom.integrations.twitch.redirect_uri'),
            config('kingdom.integrations.twitch.scopes')
        );
    }

    public function auth(string $code): OAuthAccessDTO
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

        return TwitchOAuthAccessDTO::make(
            json_decode($response->getBody()->getContents(), true)
        );
    }

    public function getAuthenticatedUser(OAuthAccessDTO $credentials): OAuthUserDTO
    {
        $uri = "https://api.twitch.tv/helix/users";
        $response = $this->client->request('GET', $uri, [
            'headers' => [
                'Client-ID' => config('kingdom.integrations.twitch.client_id'),
                'Authorization' => 'Bearer ' . $credentials->accessToken,
            ]
        ]);

        $payload = json_decode($response->getBody()->getContents(), true);
        return TwitchOAuthDTO::make($credentials, $payload);
    }
}
