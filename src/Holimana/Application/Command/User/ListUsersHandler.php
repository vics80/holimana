<?php

namespace Holimana\Application\Command\User;


use Holimana\Domain\User\UserCollection;
use Holimana\Application\Command\CommandHandler;
//use Holimana\Application\Response\CollectionResponse;
//use Holimana\Application\Response\OrderCollectionResponse;
use Holimana\Domain\User\UserRepository;

class ListUsersHandler extends CommandHandler
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param ListUsers $listOrders
     * @return UserCollection
     */
    public function handle(ListUsers $listOrders): UserCollection
    {
        $userCollection = $this->userRepository->findAll();

        //return new OrderCollectionResponse($orderCollection->toArray(), $orderCollection->count());
        return $userCollection;
    }

}