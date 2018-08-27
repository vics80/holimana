<?php

namespace Holimana\Domain\Event;


interface DomainEventSubscriber
{
    /**
     * @param PublishableDomainEvent | DomainEvent $aDomainEvent
     */
    public function handle($aDomainEvent);
    /**
     * @param DomainEvent $aDomainEvent
     * @return bool
     */
    public function isSubscribedTo($aDomainEvent);
}