<?php
/**
 * Created by PhpStorm.
 * User: vigarcia
 * Date: 24/08/18
 * Time: 13:42
 */

namespace Holimana\Domain\Day;

class DayFactory
{
    public static function create(
        UserId $userId,
        $firstname,
        $lastname,
        $email,
        $password,
        DayCollection $dayCollection = null
    )
    {
        return new User(
            $userId,
            $firstname,
            $lastname,
            $email,
            $password,
            $dayCollection
        );
    }
}