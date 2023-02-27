<?php

namespace Kingdom\Subscription\Domain\Collections;

use ArrayIterator;
use Kingdom\Subscription\Domain\Entities\SubscriptionEntity;

class SubscriptionsCollection extends ArrayIterator
{
    public function add(SubscriptionEntity $entity)
    {
        $this->append($entity);
    }
}
