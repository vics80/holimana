<?php

namespace Holimana\Application\Command\User;


use Holimana\Domain\User\User;
use Holimana\Domain\User\UserCollection;
use Holimana\Application\Command\CommandHandler;
//use Holimana\Application\Response\CollectionResponse;
//use Holimana\Application\Response\OrderCollectionResponse;
use Holimana\Domain\User\UserRepository;

class FindUserHandler extends CommandHandler
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(FindUser $findUser): User
    {
        $user = $this->userRepository->findById($findUser->userId());

        return $user;
    }

}