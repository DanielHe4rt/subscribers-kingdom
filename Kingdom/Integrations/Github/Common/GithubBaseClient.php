<?php

namespace Kingdom\Integrations\Github\Common;

use GuzzleHttp\Client;
use Kingdom\Integrations\Github\OAuth\Domain\Contracts\GithubOAuthContract;
use Kingdom\Integrations\Github\OAuth\Infrastructure\GithubAuthClient;

class GithubBaseClient
{
    public function __construct(private readonly Client $client)
    {
    }

    public function oauth(): GithubOAuthContract
    {
        return new GithubAuthClient($this->client);
    }
}
