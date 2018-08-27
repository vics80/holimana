<?php

namespace Holimana\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Holimana\Domain\User\UserId;

class DoctrineUserId extends IntegerType
{
    public function getName()
    {
        return 'UserId';
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /**@var UserId $value */
        return !empty($value) ? $value->id() : null;
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return UserId|mixed
     * @throws \Holimana\Domain\Exception\InvalidDomainIdException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value ? new UserId($value) : null;
    }
}