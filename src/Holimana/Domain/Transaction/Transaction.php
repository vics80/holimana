<?php

namespace Holimana\Domain\Transaction;

use Holimana\Domain\Entity;
use Holimana\Domain\Order\Order;
use Holimana\Domain\Order\OrderId;
use Holimana\Domain\DomainEventPublisher;

class Transaction extends Entity
{
    /**
     * @var OrderId
     */
    private $order;
    private $transactionNumber;

    /**
     * Transaction constructor.
     * @param TransactionId|null $id
     * @param Order $order
     * @param null $transactionNumber
     */
    public function __construct(
        TransactionId $id = null,
        Order $order,
        $transactionNumber = null
    )
    {
        $this->id = $id;
        $this->order = $order;
        $this->transactionNumber = $transactionNumber;
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
    public function transactionNumber()
    {
        return $this->transactionNumber;
    }

    /**
     * @param null $transactionNumber
     */
    public function setTransactionNumber($transactionNumber)
    {
        $this->transactionNumber = $transactionNumber;
    }

}