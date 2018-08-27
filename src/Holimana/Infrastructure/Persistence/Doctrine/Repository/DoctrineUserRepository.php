<?php
/**
 * Created by PhpStorm.
 * User: vigarcia
 * Date: 27/08/18
 * Time: 9:41
 */

namespace Holimana\Infrastructure\Persistence\Doctrine\Repository;


use Doctrine\ORM\EntityNotFoundException;
use Holimana\Domain\User\UserCollection;
use Holimana\Domain\User\User;
use Holimana\Domain\User\UserId;
use Holimana\Domain\User\UserRepository;

class DoctrineUserRepository extends DoctrineRepository implements UserRepository
{

    public function findAll()
    {
        $result = $this->repository->findAll();

        $this->checkEmptyColectionResult($result);

        return $this->buildCollection($result);
    }

    public function findById(UserId $id): User
    {
        $result = $this->repository->find($id);

        $this->checkEmptySingleResult($result);

        return $result;
    }


    public function findBy(array $criteria)
    {
        $result = $this->repository->findBy($criteria);

        $this->checkEmptyColectionResult($result);


    }

    public function persist(User $card)
    {
        // TODO: Implement persist() method.
    }

    protected function createQuery()
    {
        return $this->entityManager->createQueryBuilder();
    }

    protected function getEntityClassName()
    {
        return User::class;
    }

    protected function getCollectionClassName()
    {
        return UserCollection::class;
    }
}