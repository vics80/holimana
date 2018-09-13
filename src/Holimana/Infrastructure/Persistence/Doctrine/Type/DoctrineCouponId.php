<?php

namespace Holimana\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Holimana\Domain\Coupon\CouponId;

class DoctrineCouponId extends IntegerType
{
    public function getName()
    {
        return 'CouponId';
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        /**@var CouponId $value */
        return $value->id();
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @throws \Holimana\Domain\Exception\InvalidDomainIdException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new CouponId($value);
    }
}