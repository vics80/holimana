<?php

namespace Holimana\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Holimana\Domain\Role\RoleId;

class DoctrineRoleId extends StringType
{
    public function getName()
    {
        return 'RoleId';
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /**@var UserId $value */
        return $value instanceof RoleId ? $value->id() : $value;
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return RoleId|mixed
     * @throws \Holimana\Domain\Exception\InvalidDomainIdException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new RoleId($value);
    }
}