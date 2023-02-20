<?php

namespace Kingdom\Integrations\Github\OAuth\Infrastructure;

use GuzzleHttp\Client;
use Kingdom\Authentication\OAuth\Domain\DTO\OAuthAccessDTO;
use Kingdom\Authentication\OAuth\Domain\DTO\OAuthUserDTO;
use Kingdom\Integrations\Github\OAuth\Domain\Contracts\GithubOAuthContract;
use Kingdom\Integrations\Github\OAuth\Domain\DTOs\GithubOAuthAccessDTO;
use Kingdom\Integrations\Github\OAuth\Domain\DTOs\GithubUserDTO;

class GithubAuthClient implements GithubOAuthContract
{
    public function __construct(private readonly Client $client)
    {
    }

    public function redirectUrl(): string
    {
        return sprintf(
            'https://github.com/login/oauth/authorize?client_id=%s&redirect_uri=%s&scope=%s',
            config('kingdom.integrations.github.client_id'),
            config('kingdom.integrations.github.redirect_uri'),
            config('kingdom.integrations.github.scopes')
        );
    }

    public function auth(string $code): OAuthAccessDTO
    {
        $url = "https://github.com/login/oauth/access_token";

        $response = $this->client->request('POST', $url, [
            'form_params' => [
                'client_id' => config('kingdom.integrations.github.client_id'),
                'client_secret' => config('kingdom.integrations.github.client_secret'),
                'code' => $code,
            ],
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);
        return GithubOAuthAccessDTO::make($response);
    }

    public function getAuthenticatedUser(OAuthAccessDTO $credentials): OAuthUserDTO
    {
        $uri = "https://api.github.com/user";
        $response = $this->client->request('GET', $uri, [
            'headers' => ['Authorization' => 'Bearer ' . $credentials->accessToken]
        ]);

        $result = json_decode($response->getBody(), true);

        return GithubUserDTO::make($credentials, $result);
    }
}
