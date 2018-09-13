<?php

namespace Holimana\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Holimana\Domain\Transaction\TransactionId;

class DoctrineTransactionId extends IntegerType
{
    public function getName()
    {
        return 'TransactionId';
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /**
         * @var TransactionId $value
         */
        return $value instanceof TransactionId ? $value->id() : $value;
    }

    /**
     * @param $value
     * @param AbstractPlatform $platform
     * @return int|TransactionId|mixed|null
     * @throws \Holimana\Domain\Exception\InvalidDomainIdException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new TransactionId($value);
    }
}