<?php
/**
 * Created by PhpStorm.
 * User: vigarcia
 * Date: 24/08/18
 * Time: 13:42
 */

namespace Holimana\Domain\User;


use Holimana\Domain\Day\DayCollection;

class UserFactory
{
    public static function create(
        UserId $userId,
        $firstname,
        $lastname,
        $email,
        $password,
        \DateTime $birthday,
        DayCollection $dayCollection = null
    )
    {
        return new User(
            $userId,
            $firstname,
            $lastname,
            $email,
            $password,
            $birthday,
            $dayCollection
        );
    }
}