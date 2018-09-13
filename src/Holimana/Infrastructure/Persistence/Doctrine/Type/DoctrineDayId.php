<?php

namespace Holimana\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Holimana\Domain\Day\DayId;

class DoctrineDayId extends StringType
{
    public function getName()
    {
        return 'DayId';
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /**@var DayId $value */
        return $value instanceof DayId ? $value->id() : $value;
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return DayId|mixed
     * @throws \Holimana\Domain\Exception\InvalidDomainIdException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new DayId($value);
    }
}