<?php

namespace Holimana\Application\Command\User;


use Holimana\Application\Service\PasswordHasher;
use Holimana\Domain\User\User;
use Holimana\Application\Command\CommandHandler;
use Holimana\Domain\User\UserRepository;

class CreateUserHandler extends CommandHandler
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var PasswordHasher
     */
    private $passwordHasher;

    public function __construct(
        UserRepository $userRepository,
        PasswordHasher $passwordHasher
    )
    {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
    }

    public function handle(CreateUser $createUser): User
    {
        $user = $this->buildUser($createUser);

        $this->userRepository->insert($user);

        return $user;
    }

    private function buildUser(CreateUser $createUser)
    {
        $user = new User(
            $createUser->userId(),
            $createUser->firstname(),
            $createUser->lastname(),
            $createUser->email(),
            $createUser->password(),
            new \DateTime(),
            null,
            $createUser->role()
        );

        $user->setPassword($this->passwordHasher->generate($createUser->password()));

        return $user;
    }
}