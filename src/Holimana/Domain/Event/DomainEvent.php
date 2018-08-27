<?php

namespace Holimana\Domain\Event;


interface DomainEvent
{
    /**
     * @return \DateTime
     */
    public function occurredOn();

    public function serialize();

    public function type();
}