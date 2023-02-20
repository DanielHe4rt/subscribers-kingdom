<?php

namespace Kingdom\Integrations\Github\Common;

use Kingdom\Integrations\Github\OAuth\Domain\Contracts\GithubOAuthContract;

interface GithubService
{
    public function oauth(): GithubOAuthContract;
}
