<?php

namespace Holimana\Domain\Order;

use Holimana\Domain\Coupon\Coupon;
use Holimana\Domain\Entity;
use Doctrine\Common\Collections\Collection;
use Holimana\Infrastructure\Event\DomainEventPublisher;

class Order extends Entity
{

    /**
     * @var int
     */
    protected $status;

    private $alias;

    private $transactions;

    private $coupon;

    /**
     * Order constructor.
     * @param OrderId|null $id
     * @param int $status
     * @param $alias
     * @param Collection $transactions
     * @param Coupon $coupon
     */
    public function __construct(
        OrderId $id = null,
        $status = 0,
        $alias = null,
        Collection $transactions,
        Coupon $coupon = null
    )
    {
        $this->id = $id;
        $this->status = $status;
        $this->alias = $alias;
        $this->transactions = $transactions;
        $this->coupon= $coupon;
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
        DomainEventPublisher::raise(new OrderStatusChanged($this));
    }

    /**
     * @return mixed
     */
    public function alias()
    {
        return $this->alias;
    }

    /**
     * @param mixed $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return Collection
     */
    public function transactions(): Collection
    {
        return $this->transactions;
    }

    /**
     * @param Collection $transactions
     */
    public function setTransactions(Collection $transactions)
    {
        $this->transactions = $transactions;
    }

    /**
     * @return Coupon
     */
    public function coupon(): Coupon
    {
        return $this->coupon;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }

}