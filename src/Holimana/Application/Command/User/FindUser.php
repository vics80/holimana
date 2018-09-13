<?php

namespace Holimana\Application\Command\User;


use Holimana\Application\Command\Command;
use Holimana\Infrastructure\Persistence\FilterCriteria;

class FindUser extends Command
{

    private $userId;

    public function __construct(
        $userId = null
    )
    {
        $this->userId = $userId;
    }

    public function userId()
    {
        return $this->userId;
    }
}