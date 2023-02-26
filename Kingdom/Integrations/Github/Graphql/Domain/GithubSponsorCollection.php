<?php

namespace Kingdom\Integrations\Github\Graphql\Domain;

use ArrayIterator;

class GithubSponsorCollection extends ArrayIterator
{

    public static function make(array $rawSponsors): self
    {
        $sponsors = [];
        foreach ($rawSponsors as $rawSponsor) {
            $sponsors[] = GithubSponsorEntity::make($rawSponsor);
        }

        return new self($sponsors);
    }

    public function add(GithubSponsorEntity $entity)
    {
        $this->append($entity);
    }
}
