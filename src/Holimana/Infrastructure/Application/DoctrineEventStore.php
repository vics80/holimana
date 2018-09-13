<?php

namespace Holimana\Infrastructure\Application;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Holimana\Application\EventStore;
use Holimana\Domain\Event\DomainEvent;
use Holimana\Domain\StoredEvent;
use JMS\Serializer\SerializerBuilder;

class DoctrineEventStore implements EventStore
{
    private $serializer;
    private $entityManager;

    public function __construct(
        EntityManager $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

    public function append($aDomainEvent)
    {
        $storedEvent = new StoredEvent(
            null,
            $this->serializer()->serialize($aDomainEvent, 'json'),
            get_class($aDomainEvent),
            $aDomainEvent->occurredOn()

        );

        $this->entityManager->persist($storedEvent);
        $this->entityManager->flush();
    }

    public function allStoredEventsSince($anEventId)
    {
        $query = $this->createQueryBuilder('e');

        if ($anEventId) {
            $query->where('e.event_id > :eventId');
            $query->setParameters([
                'eventId' => $anEventId
            ]);
        }

        $query->orderBy('e.event_id');

        return $query->getQuery()->getResult();
    }

    /**
     * @return \JMS\Serializer\Serializer
     */
    private function serializer()
    {
        if (null === $this->serializer) {
            $this->serializer = SerializerBuilder::create()->build();
        }

        return $this->serializer;
    }

}