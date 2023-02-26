<?php

namespace Kingdom\Integrations\Github\Graphql\Domain;

class GithubSponsorEntity
{
    public function __construct(
        public readonly string $username,
        public readonly bool $isSponsor
    )
    {
    }

    public static function make(mixed $rawSponsor): self
    {
        return new self(
            username: $rawSponsor['login'],
            isSponsor:$rawSponsor['viewerIsSponsoring']
        );
    }
}
