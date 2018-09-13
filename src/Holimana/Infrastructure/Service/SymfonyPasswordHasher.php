<?php

namespace Holimana\Infrastructure\Service;

use App\Security\NullUser;
use Holimana\Application\Service\PasswordHasher;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SymfonyPasswordHasher implements PasswordHasher
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function generate($plainPassword)
    {
        return $this->encoder->encodePassword(new NullUser(), $plainPassword);
    }
}