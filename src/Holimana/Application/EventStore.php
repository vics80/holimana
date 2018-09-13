<?php

namespace Holimana\Application;


use Holimana\Domain\Event\DomainEvent;

interface EventStore
{
    /**
     * @param \Common\Domain\DomainEvent $aDomainEvent
     * @return mixed
     */
    public function append($aDomainEvent);

    /**
     * @param $anEventId
     * @return DomainEvent[]
     */
    public function allStoredEventsSince($anEventId);
}