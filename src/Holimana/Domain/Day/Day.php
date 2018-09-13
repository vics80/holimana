<?php

namespace Holimana\Domain\Day;

use Holimana\Domain\User\User;

/**
 * Class Day
 * @package Holimana\Domain\Day
 */
class Day
{
    /**
     * @var DayId
     */
    private $id;
    /**
     * @var \DateTime
     */
    private $date;
    /**
     * @var user
     */
    private $user;
    /**
     * @var
     */
    private $status;

    /**
     * Day constructor.
     * @param $id
     * @param $date
     * @param $user
     * @param $status
     */
    public function __construct(
        DayId $id,
        \DateTime $date,
        User $user,
        $status
    )
    {
        $this->id = $id;
        $this->date = $date;
        $this->user = $user;
        $this->status = $status;
    }

    /**
     * @return DayId
     */
    public function id(): DayId
    {
        return $this->id;
    }

    /**
     * @return \DateTimeInterface
     */
    public function date(): \DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param \DateTimeInterface $date
     */
    public function setDate(\DateTimeInterface $date)
    {
        $this->date = $date;
    }

    /**
     * @return User
     */
    public function user(): User
    {
        return $this->user;
    }

    /**
     * @param User $User
     */
    public function setUser(User $User)
    {
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function status(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }
}
