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

    public function __construct($id = null)
    {
        $this->id = null === $id ? Uuid::uuid4()->toString() : $id;
    }

    public function equals(Id $id)
    {
        return $this->id() === $id->id();
    }

    public function id()
    {
        return $this->id;
    }
}