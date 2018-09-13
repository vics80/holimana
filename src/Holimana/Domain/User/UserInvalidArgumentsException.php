<?php
/**
 * Created by PhpStorm.
 * User: vigarcia
 * Date: 12/09/18
 * Time: 15:35
 */

namespace Holimana\Domain\User;


use Assert\LazyAssertionException;

class UserInvalidArgumentsException extends LazyAssertionException
{
    public function __construct($message, array $errors = [])
    {
        parent::__construct($message, $errors);
    }
}