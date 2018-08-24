<?php
/**
 * Created by PhpStorm.
 * User: vigarcia
 * Date: 24/08/18
 * Time: 12:56
 */

namespace Holimana\Domain;


class IdFactory
{
    public static function create($id = null)
    {
        return new Id($id);
    }
}