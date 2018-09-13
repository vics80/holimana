<?php
namespace App\Security;

use Symfony\Component\Security\Core\User\UserInterface;

class NullUser implements UserInterface
{
    private $password;

    public function __construct($password = null)
    {
        $this->password = $password;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}