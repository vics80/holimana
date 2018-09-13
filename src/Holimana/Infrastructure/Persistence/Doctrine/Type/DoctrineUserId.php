<?php

namespace Holimana\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Holimana\Domain\User\UserId;

class DoctrineUserId extends StringType
{
    public function getName()
    {
        return 'UserId';
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /**@var UserId $value */
        return $value instanceof UserId ? $value->id() : $value;
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return UserId|mixed
     * @throws \Holimana\Domain\Exception\InvalidDomainIdException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new UserId($value);
    }
}