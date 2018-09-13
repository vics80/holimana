<?php

namespace Holimana\Domain\User;

use Assert\Assert;
use Assert\Assertion;
use Assert\InvalidArgumentException;
use Common\Domain\Collection;
use Holimana\Domain\DomainEventPublisher;
use Holimana\Domain\Entity;
use Holimana\Domain\Role\Role;
use Respect\Validation\Validator;

class User extends Entity
{
    private $firstname;
    private $lastname;
    private $email;
    private $plainPassword;
    private $password;
    private $days;
    private $birthday;
    /**
     * @var Role
     */
    private $role;


    /**
     * User constructor.
     * @param UserId|null $id
     * @param $firstname
     * @param $lastname
     * @param $email
     * @param $plainPassword
     * @param \Datetime $birthday
     * @param Collection|null $days
     * @param Role $role
     */
    public function __construct(
        UserId $id = null,
        $firstname,
        $lastname = null,
        $email,
        $plainPassword,
        \Datetime $birthday,
        Collection $days = null,
        Role $role = null
    )
    {
        $this->id = $id;
        $this->setFirstname($firstname);
        $this->lastname = $lastname;
        $this->setEmail($email);
        $this->setPlainPassword($plainPassword);
        $this->birthday = $birthday;
        $this->setDays($days);
        $this->role = $role;

        DomainEventPublisher::instance()->publish(
            new UserCreated(
                $this
            )
        );
    }

    /**
     * @return UserId
     */
    public function id()
    {
        return $this->id;
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
        Assert::lazy()
            ->that($firstname, 'firstname')
            ->setExceptionClass(UserInvalidArgumentsException::class)
            ->verifyNow();
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
        Assert::lazy()
            ->that($email, 'valid email')
            ->setExceptionClass(UserInvalidArgumentsException::class)
            ->verifyNow();
        $this->email = $email;
    }


    /**
     * @return mixed
     */
    public function plainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        Assert::lazy()
            ->that($plainPassword, 'length')
            ->betweenLength(8,32)
            ->setExceptionClass(UserInvalidArgumentsException::class)
            ->verifyNow();
        $this->plainPassword = $plainPassword;
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
     * @return \Datetime
     */
    public function birthday(): \Datetime
    {
        return $this->birthday;
    }

    /**
     * @param \DateTime $birthday
     */
    public function setBirthday(\DateTime $birthday)
    {
        $this->birthday = $birthday;
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

    /**
     * @return Role
     */
    public function role(): Role
    {
        return $this->role;
    }

    /**
     * @param Role $role
     */
    public function setRole(Role $role)
    {
        $this->role = $role;
    }
}
