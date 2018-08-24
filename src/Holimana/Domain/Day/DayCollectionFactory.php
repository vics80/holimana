<?php
/**
 * Created by PhpStorm.
 * User: vigarcia
 * Date: 24/08/18
 * Time: 13:39
 */

namespace Holimana\Domain\Day;


class DayCollectionFactory
{
    public static function create()
    {
        return new DayCollection();
    }
}