<?php

namespace Holimana\Infrastructure\Persistence\Doctrine\Repository;


use function Couchbase\defaultDecoder;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\QueryBuilder as OrmQueryBuilder;
use Doctrine\ORM\EntityRepository;
use Holimana\Domain\DomainRepository;
use Holimana\Domain\Entity;
use Holimana\Domain\Event\EventPublisher;
use Holimana\Infrastructure\Persistence\FilterCondition;
use Holimana\Infrastructure\Persistence\FilterCriteria;
use Holimana\Infrastructure\Persistence\MountQueryException;
use Psr\Log\LoggerInterface;

abstract class DoctrineRepository implements DomainRepository
{
    /**
     * @var EntityRepository
     */
    protected $repository;

    protected $entityManager;

    protected $table;
    /**
     * @var EventPublisher
     */
    protected $eventPublisher;

    protected $exists;
    /**
     * @var LoggerInterface
     */
    protected $logger;

    protected $transactionMode;

    /**
     * DoctrineRepository constructor.
     * @param EntityManager $entityManager
     * @param EventPublisher $eventPublisher
     * @param LoggerInterface $logger
     * @throws \Doctrine\ORM\ORMException
     */
    public function __construct(
        EntityManager $entityManager,
        //EventPublisher $eventPublisher,
        LoggerInterface $logger
    )
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository($this->getEntityClassName());
        $this->table = $this->entityManager->getClassMetadata($this->getEntityClassName())->getTableName();
        //$this->eventPublisher = $eventPublisher;
        $this->exists = false;
        $this->logger = $logger;
    }

    /**
     * @param OrmQueryBuilder $query
     * @param FilterCriteria $criteria
     * @return OrmQueryBuilder
     * @throws MountQueryException
     */
    public function mountQuery(OrmQueryBuilder $query, FilterCriteria $criteria): OrmQueryBuilder
    {
        try {
            foreach ($criteria->conditions() as $condition) {
                /** @var FilterCondition $condition */
                $paramName = str_replace('.', '', $condition->field().rand());
                $target = $condition->target();

                if (is_array($condition->target())) {
                    $target = $condition->target()[0];
                }

                $query->andwhere($condition->field() . ' ' . $condition->operator() . ' :' . $paramName)
                    ->setParameter($paramName, $target);

                if (is_array($condition->target())) {
                    $targets = $condition->target();
                    array_shift($targets);
                    foreach ($targets as $matchKey => $matchValue) {
                        $query->orWhere($condition->field() . ' ' . $condition->operator() . ' :' . $paramName . $matchKey)
                            ->setParameter($paramName . $matchKey, $matchValue);
                    }
                }
            }
            if ($criteria->like()) {
                $query->andWhere($criteria->like()[0] . " LIKE :like");
                $query->setParameter(":like", "%" . $criteria->like()[1] . "%");
            }

            if ($criteria->notIn()) {
                $query->andWhere($criteria->notIn()[0] . " NOT IN  ( :notIn )");
                $arrayValues = array_map("addslashes", $criteria->notIn()[1]);
                $query->setParameter(":notIn", $arrayValues);
            }

            if ($criteria->orderBy()) {
                $query->orderBy($criteria->orderBy(), $criteria->orderByType());
            }

            if ($criteria->offset()) {
                $query->setFirstResult($criteria->offset());
            }

            if ($criteria->limit()) {
                $query->setMaxResults($criteria->limit());
            }


        } catch (\Throwable $error) {
            throw new MountQueryException($error->getMessage());
        }

        return $query;

    }

    public function beginTransaction()
    {
        $this->entityManager->beginTransaction();
        $this->transactionMode = true;
    }

    /**
     * @throws \Doctrine\DBAL\ConnectionException
     */
    public function rollback()
    {
        $this->transactionMode = false;
        $this->entityManager->rollback();

        $connection = $this->entityManager->getConnection();
        if (!$connection->isTransactionActive() || $connection->isRollbackOnly()) {
            $this->entityManager->close();
        }
    }

    /**
     * @param Entity $entity
     * @return Entity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(Entity $entity)
    {
        if (!$this->entityManager->isOpen()) {
            $this->entityManager = $this->entityManager->create(
                $this->entityManager->getConnection(),
                $this->entityManager->getConfiguration()
            );
        }

        $this->entityManager->merge($entity);
        $this->entityManager->flush();

        return $entity;
    }

    public function insert(Entity $entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    abstract protected function getEntityClassName();

    abstract protected function getCollectionClassName();

    abstract protected function createQuery();

    /**
     * @param Entity $entity
     * @throws \Doctrine\ORM\ORMException
     */
    protected function insertOrUpdate(Entity $entity)
    {
        /** TODO: Always try to insert, updates pending */
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    protected function haveId(Entity $entity)
    {
        $id = $entity->id() ? $entity->id()->id() ?? null : null;

        if (!($entity->id()) || $id ? $id : false) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param Entity $entity
     */
    protected function setDateValues(Entity $entity)
    {
        $entity->setUpdatedAt(new \DateTime('now'));

        if ($entity->createdAt() == null) {
            $entity->setCreatedAt(new \DateTime('now'));
        }

    }

    /**
     * @param $entityClassName
     * @return string
     */
    protected function getEntityTable($entityClassName)
    {
        return $this->entityManager->getClassMetadata($entityClassName)->getTableName();
    }

    protected function getQueryBuilder()
    {
        return new QueryBuilder($this->entityManager->getConnection());
    }

    /**
     * @param $result
     */
    protected function checkEmptySingleResult($result)
    {
        if (empty($result)) {
            throw new EntityNotFoundException($this->getEntityClassName() . ' not found');
        }
    }

    /**
     * @param $result
     */
    protected function checkEmptyColectionResult($result)
    {
        if (empty($result)) {
            throw new EntityNotFoundException('No ' . $this->getEntityClassName() . ' found with this criteria');
        }
    }

    protected function buildCollection($result)
    {
        $collectionClassName = $this->getCollectionClassName();
        $collection = new $collectionClassName;

        foreach($result as $row)
        {
            $collection->add($row);
        }

        return $collection;
    }


}