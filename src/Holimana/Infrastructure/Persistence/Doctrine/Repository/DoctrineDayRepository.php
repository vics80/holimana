<?php
/**
 * Created by PhpStorm.
 * User: vigarcia
 * Date: 27/08/18
 * Time: 9:41
 */

namespace Holimana\Infrastructure\Persistence\Doctrine\Repository;


use Doctrine\ORM\EntityNotFoundException;
use Holimana\Domain\Day\DayCollection;
use Holimana\Domain\Day\Day;
use Holimana\Domain\Day\DayId;
use Holimana\Domain\Day\DayRepository;

class DoctrineDayRepository extends DoctrineRepository implements DayRepository
{

    public function findAll(): DayCollection
    {
        $result = $this->repository->findAll();

        $this->checkEmptyColectionResult($result);

        return $this->buildCollection($result);
    }

    public function findById(DayId $id): Day
    {
        $result = $this->repository->find($id);

        $this->checkEmptySingleResult($result);

        return $result;
    }


    public function findBy(array $criteria): DayCollection
    {
        $result = $this->repository->findBy($criteria);

        $this->checkEmptyColectionResult($result);


    }

    public function persist(Day $day)
    {
        $this->insertOrUpdate($day);
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