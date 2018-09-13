<?php
namespace Holimana\Domain\Coupon;

use Holimana\Domain\Entity;
use Holimana\Domain\Order\Order;
use Holimana\Domain\DomainEventPublisher;

class Coupon extends Entity
{
    /**
     * @var Order
     */
    private $order;
    private $number;
    /**
     * Coupon constructor.
     * @param CouponId|null $id
     * @param Order $order
     * @param $number
     */
    public function __construct(
        CouponId $id = null,
        Order $order,
        $number
    )
    {
        $this->order = $order;
        $this->number = $number;
    }

    /**
     * @return Order
     */
    public function order(): Order
    {
        return $this->order;
    }

    /**
     * @return mixed
     */
    public function number()
    {
        return $this->number;
    }
}