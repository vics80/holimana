<?php

namespace Holimana\Application\Command\User;


use Holimana\Domain\User\User;
use Holimana\Domain\User\UserCollection;
use Holimana\Application\Command\CommandHandler;
//use Holimana\Application\Response\CollectionResponse;
//use Holimana\Application\Response\OrderCollectionResponse;
use Holimana\Domain\User\UserRepository;

class UpdateUserHandler extends CommandHandler
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(UpdateUser $updateUser): User
    {
        $updateUser->user()->setFirstname($updateUser->firstname());
        $updateUser->user()->setLastname($updateUser->lastname());
        $updateUser->user()->setEmail($updateUser->email());
        $updateUser->user()->setPassword($updateUser->password());

        $user = $this->userRepository->update($updateUser->user());

        return $user;
    }

}