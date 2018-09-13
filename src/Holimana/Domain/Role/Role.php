<?php

namespace Holimana\Domain\Role;

use Holimana\Domain\Entity;
use Holimana\Domain\User\UserCollection;

class Role extends Entity
{
    private $name;
    private $users;


    /**
     * Role constructor.
     * @param RoleId|null $id
     * @param $name
     * @param UserCollection $users
     */
    public function __construct(
        RoleId $id = null,
        $name,
        UserCollection $users = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->users = $users;
    }

    /**
     * @return RoleId
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return User
     */
    public function users(): UserCollection
    {
        return $this->users;
    }

    /**
     * @param UserCollection $users
     */
    public function setUser($users)
    {
        $this->users = $users;
    }
}
