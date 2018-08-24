<?php

namespace Holimana\Domain\User;

use Common\Domain\Collection;

class User
{
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $days;

    /**
     * User constructor.
     * @param $id
     * @param $firstname
     * @param $lastname
     * @param $email
     * @param $password
     * @param $days
     */
    public function __construct(
        $id,
        $firstname,
        $lastname,
        $email,
        $password,
        Collection $days = null
    )
    {
        $this->setId($id);
        $this->setFirstname($firstname);
        $this->setLastname($lastname);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setDays($days);
    }

    /**
     * @return mixed
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function firstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function lastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function password()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return Collection
     */
    public function days()
    {
        return $this->days;
    }

    /**
     * @param Collection $days
     */
    public function setDays($days)
    {
        $this->days = $days;
    }
}
