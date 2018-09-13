<?php

namespace Holimana\Application\Command\User;


use Holimana\Application\Command\Command;
use Holimana\Domain\User\User;
use Holimana\Domain\User\UserId;

class CreateUser extends Command
{

    private $userId;
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $user;

    public function __construct(
        UserId $userId = null,
        $firstname,
        $lastname,
        $email,
        $password
    )
    {
        $this->userId = !empty($userId) ? $userId : new UserId();
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
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
}