<?php
/**
 * Created by PhpStorm.
 * User: vigarcia
 * Date: 24/08/18
 * Time: 13:41
 */

namespace Holimana\Domain\User;

class UserIdFactory
{
    public static function create ($id = null)
    {
        return new UserId($id);
    }
}