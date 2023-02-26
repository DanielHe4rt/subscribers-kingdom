<?php

namespace Kingdom\Integrations\Github\Graphql\Infrastructure;

use GuzzleHttp\Client;
use Kingdom\Authentication\OAuth\Domain\DTO\OAuthAccessDTO;
use Kingdom\Integrations\Github\Graphql\Domain\GithubGraphqlService;

class GithubGraphqlClient implements GithubGraphqlService
{
    private string $uri = 'https://api.github.com/graphql';

    public function __construct(private readonly Client $client)
    {
    }

    public function retrieveSponsors(OAuthAccessDTO $credentials, string $username)
    {
        $query = '
            {
              user(login: "%s") {
                ... on Sponsorable {
                  sponsoring(first: 50) {
                    totalCount
                    nodes {
                      ... on User {
                        login,
                        viewerIsSponsoring,
                      }
                    }
                  }
                }
              }
            }
        ';

        $query = sprintf($query, $username);


        $response = $this->client->request('GET', $this->uri, [
            'headers' => ['Authorization' => 'Bearer ' . $credentials->accessToken],
            'json' => ['query' => $query]
        ]);

        $a =  json_decode($response->getBody()->getContents(), true);
        dd($a);
    }
}
