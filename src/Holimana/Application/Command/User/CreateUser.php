<?php

namespace Holimana\Application\Command\User;


use Holimana\Application\Command\Command;
use Holimana\Domain\Role\Role;
use Holimana\Domain\User\User;
use Holimana\Domain\User\UserId;

class CreateUser extends Command
{

    /**
     * @var UserId
     */
    private $userId;
    /**
     * @var
     */
    private $firstname;
    /**
     * @var
     */
    private $lastname;
    /**
     * @var
     */
    private $email;
    /**
     * @var
     */
    private $password;
    /**
     * @var Role
     */
    private $role;


    public function __construct(
        UserId $userId = null,
        $firstname,
        $lastname,
        $email,
        $password,
        Role $role
    )
    {
        $this->userId = !empty($userId) ? $userId : new UserId();
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function userId()
    {
        return $this->userId;
    }

    public function firstname()
    {
        return $this->firstname;
    }

    public function lastname()
    {
        return $this->lastname;
    }

    public function email()
    {
        return $this->email;
    }

    public function password()
    {
        return $this->password;
    }

    /**
     * @return Role
     */
    public function role(): Role
    {
        return $this->role;
    }
}