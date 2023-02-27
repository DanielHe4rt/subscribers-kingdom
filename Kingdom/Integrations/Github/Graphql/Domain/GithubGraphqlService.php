<?php

namespace Kingdom\Integrations\Github\Graphql\Domain;

use Kingdom\Authentication\OAuth\Domain\DTO\OAuthAccessDTO;

interface GithubGraphqlService
{
    public function retrieveSponsors(OAuthAccessDTO $credentials, string $username);
}
