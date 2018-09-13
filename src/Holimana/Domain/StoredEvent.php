<?php
/**
 * Created by PhpStorm.
 * User: vigarcia
 * Date: 30/08/18
 * Time: 11:40
 */

namespace Holimana\Domain;


class StoredEvent
{
    private $event_id;
    private $event_body;
    private $type_name;
    private $occurred_on;

    /**
     * StoredEvent constructor.
     * @param $event_id
     * @param $event_body
     * @param $type_name
     * @param $occurred_on
     */
    public function __construct(
        $event_id = null,
        $event_body,
        $type_name,
        \DateTime $occurred_on
    )
    {
        $this->event_id = $event_id;
        $this->event_body = $event_body;
        $this->type_name = $type_name;
        $this->occurred_on = $occurred_on;
    }

    /**
     * @return mixed
     */
    public function eventId()
    {
        return $this->event_id;
    }

    /**
     * @param integer $event_id
     */
    public function setEventId(int $event_id)
    {
        $this->event_id = $event_id;
    }

    /**
     * @return mixed
     */
    public function eventBody()
    {
        return $this->event_body;
    }

    /**
     * @param mixed $event_body
     */
    public function setEventBody($event_body)
    {
        $this->event_body = $event_body;
    }

    /**
     * @return mixed
     */
    public function typeName()
    {
        return $this->type_name;
    }

    /**
     * @param mixed $type_name
     */
    public function setTypeName($type_name)
    {
        $this->type_name = $type_name;
    }

    /**
     * @return \DateTime
     */
    public function occurredOn()
    {
        return $this->occurred_on;
    }

    /**
     * @param \DateTime $occurred_on
     */
    public function setOccurredOn(\DateTime $occurred_on)
    {
        $this->occurred_on = $occurred_on;
    }


}