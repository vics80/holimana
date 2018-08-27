<?php

namespace Holimana\Infrastructure\Event;


use Holimana\Domain\Event\DomainEvent;
use Holimana\Domain\Event\DomainEventSubscriber;
use Holimana\Domain\Event\EventPublisher;

class DomainEventPublisher implements EventPublisher
{
    public function subscribe(DomainEventSubscriber $aDomainEventSubscriber)
    {
        // TODO: Implement subscribe() method.
    }

    public function publish(DomainEvent $event)
    {
        // TODO: Implement publish() method.
    }

    public function publishSync(DomainEvent $event)
    {
        // TODO: Implement publishSync() method.
    }

    public function dispatch(DomainEvent $event)
    {
        // TODO: Implement dispatch() method.
    }

    public function unsubscribe($id)
    {
        // TODO: Implement unsubscribe() method.
    }

}