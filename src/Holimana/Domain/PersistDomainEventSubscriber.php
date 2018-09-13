<?php
/**
 * Created by PhpStorm.
 * User: vigarcia
 * Date: 30/08/18
 * Time: 12:35
 */

namespace Holimana\Domain;


use Holimana\Domain\Event\DomainEvent;
use Holimana\Domain\Event\DomainEventSubscriber;
use Holimana\Domain\Event\PublishableDomainEvent;

class PersistDomainEventSubscriber implements DomainEventSubscriber
{
    private $eventStore;

    public function __construct($eventStore)
    {
        $this->eventStore = $eventStore;
    }

    /**
     * @param DomainEvent|PublishableDomainEvent $aDomainEvent
     */
    public function handle($aDomainEvent)
    {
        $this->eventStore->append($aDomainEvent);
    }

    public function isSubscribedTo($aDomainEvent)
    {
        return true;
    }

}