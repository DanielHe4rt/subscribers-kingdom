<?php

namespace Kingdom\Integrations\Twitch\EventSub\Domain\Collections;

use ArrayIterator;
use Kingdom\Integrations\Twitch\EventSub\Domain\Entities\EventSubEntity;


class EventSubCollection extends ArrayIterator
{
    public function add(EventSubEntity $entity)
    {
        $this->append($entity);
    }

    public static function make(array $eventSubList): self
    {
        $eventSubs = [];
        foreach ($eventSubList as $eventSub) {
            $eventSubs[] = EventSubEntity::make($eventSub);
        }

        return new self($eventSubs);
    }


}
