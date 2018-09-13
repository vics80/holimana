<?php

namespace Holimana\Domain\Event;

use Holimana\Domain\Id;
use Holimana\Domain\Serializable;

class Event extends Serializable implements DomainEvent
{
    const USER_CREATED = "user was created";

    protected $id;
    protected $type = Event::class;
    protected $name = "";
    protected $eventContent = "";
    protected $occurredOn;
    protected $createdAt;

    public function __construct()
    {
        $this->occurredOn = new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function occurredOn(): \DateTime
    {
        return $this->occurredOn;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * @param $event
     * @return mixed
     */
    public function setEventContent($event)
    {
        return $this->eventContent = $event;
    }

    /**
     * @return mixed
     */
    public function createdAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function toArray()
    {
        return json_decode($this->jsonSerialize(), true);
    }

    public function serialize()
    {
        return $this->jsonSerialize();
    }

    /**
     * @param \DateTime $occurredOn
     */
    public function setOccurredOn(\DateTime $occurredOn)
    {
        $this->occurredOn = $occurredOn;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function eventContent()
    {
        return $this->eventContent;
    }

    /**
     * @return mixed
     */
    public function id()
    {
        return $this->id;
    }

}