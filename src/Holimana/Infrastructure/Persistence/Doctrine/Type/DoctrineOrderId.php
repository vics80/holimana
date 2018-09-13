<?php

namespace Holimana\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Types\IntegerType;
use Holimana\Domain\Order\OrderId;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class DoctrineOrderId extends IntegerType
{
    public function getName()
    {
        return 'OrderId';
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof OrderId ? $value->id() : $value;
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return OrderId|mixed
     * @throws \Holimana\Domain\Exception\InvalidDomainIdException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new OrderId($value);
    }
}