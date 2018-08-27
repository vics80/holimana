<?php

namespace Holimana\Domain;

abstract class Entity extends Serializable
{
    /**
     * @var Id
     */
    protected $id;

    protected $createdAt;

    protected $updatedAt;

    /**
     * @return Id
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function createdAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function updatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param Id $id
     */
    public function setId(Id $id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return array|mixed
     */
    public function toArray()
    {
        return json_decode($this->jsonSerialize(), true);
    }

    public function getIdString()
    {
        $id = $this->id();
        return isset($id) ? is_int($id) ? $id : $this->id()->id() : "";
    }

    /**
     * @param $id
     * @throws Exception\InvalidDomainIdException
     */
    public function setIdString($id)
    {
        return $this->setId(new Id($id));
    }


}