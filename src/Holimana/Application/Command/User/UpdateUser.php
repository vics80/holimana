<?php

namespace Holimana\Application\Command\User;


use Holimana\Application\Command\Command;
use Holimana\Domain\User\User;

class UpdateUser extends Command
{

    private $userId;
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $user;

    public function __construct(
        $userId,
        $firstname,
        $lastname,
        $email,
        $password,
        User $user
    )
    {
        $this->userId = $userId;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->user = $user;
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

    public function user()
    {
        return $this->user;
    }
}