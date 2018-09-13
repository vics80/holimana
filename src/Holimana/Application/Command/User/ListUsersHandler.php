<?php

namespace Holimana\Application\Command\User;


use Doctrine\ORM\EntityNotFoundException;
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
        try {
            $userCollection = $this->userRepository->findAll();
        } catch (EntityNotFoundException $exception) {
            $userCollection = new UserCollection();
        }

        //return new OrderCollectionResponse($orderCollection->toArray(), $orderCollection->count());
        return $userCollection;
    }

}