<?php
/**
 * Created by PhpStorm.
 * User: vigarcia
 * Date: 24/08/18
 * Time: 12:46
 */

namespace Holimana\Domain;


use Rhumsaa\Uuid\Uuid;

class Id
{
    private $id;

    /**
     * Id constructor.
     * @param null $id
     */
    public function __construct($id = null)
    {
        $this->id = null === $id ? Uuid::uuid4()->toString() : $id;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->id;
    }

    /**
     * @param Id $id
     * @return bool
     */
    public function equals(Id $id)
    {
        return $this->id() === $id->id();
    }

    public function id()
    {
        return $this->id;
    }
}