<?php
/**
 * Created by PhpStorm.
 * User: vigarcia
 * Date: 3/09/18
 * Time: 12:24
 */

namespace App\EventListener;


use Doctrine\ORM\EntityManager;
use Holimana\Domain\DomainEventPublisher;
use Holimana\Domain\Event\EventPublisher;
use Holimana\Domain\PersistDomainEventSubscriber;
use Holimana\Infrastructure\Application\DoctrineEventStore;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RequestListener
{
    private $eventPublisher;

    public function __construct(
        EventPublisher $eventPublisher
    )
    {
        $this->eventPublisher = $eventPublisher;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
    }
}