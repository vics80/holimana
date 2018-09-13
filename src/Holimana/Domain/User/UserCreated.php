<?php


namespace Holimana\Domain\User;


use Holimana\Domain\Event\DomainEvent;
use Holimana\Domain\Event\Event;

class UserCreated extends Event implements DomainEvent
{
    private $user;
    protected $name = EVENT::USER_CREATED;
    protected $type = UserCreated::class;

    public function __construct(
        User $user
    )
    {
        $this->user = $user;
        parent::__construct();
    }

    public function user(): User
    {
        return $this->user;
    }
}