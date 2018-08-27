<?php

namespace Holimana\Domain\Event;

interface EventPublisher
{
    public function subscribe(DomainEventSubscriber $aDomainEventSubscriber);

    public function publish(DomainEvent $event);

    public function publishSync(DomainEvent $event);

    public function dispatch(DomainEvent $event);

    public function unsubscribe($id);
}