<?php

namespace Holimana\Application\Command\User;


use Holimana\Application\Command\Command;
use Holimana\Infrastructure\Persistence\FilterCriteria;

class ListUsers extends Command
{

    /**
     * @var null
     */
    private $email;

    public function __construct(
        $email = null
    )
    {
        $this->email = $email;
    }

    /**
     * @return array
     */
    public function criteria(): FilterCriteria
    {
        $criteria = new FilterCriteria();

        if ($this->alias()) {
            $criteria->addCondition("o.alias", $this->alias());
        }

        if ($this->status() || $this->status() != null) {
            $criteria->addCondition("o.status", (int)$this->status());
        } else if ($this->noPending()) {
            $criteria->setNotIn(["o.status", [OrderStatus::STATUS_PENDING]]);
        }

        if ($this->companyId()) {
            $criteria->addCondition("o.companyId", (int)$this->companyId());
        }

        if ($this->orderId()) {
            $criteria->addCondition("o.id", (int)$this->orderId());
        }

        if ($this->customerName()) {
            $criteria->setLike(["o.lastName", trim($this->customerName())]);
        }

        if ($this->customerEmail()) {
            $criteria->setLike(["o.email", $this->customerEmail()]);
        }
        if ($this->orderByType()) {
            $criteria->setOrderBy("o.createdAt", $this->orderByType());
        } else {
            $criteria->setOrderBy("o.createdAt", "DESC");
        }

        if (!empty($this->centers())) {
            $criteria->addField("centers", $this->centers());
        }

        if ($this->coupon()) {
            $criteria->addCondition("coupon.number", $this->coupon());
        }

        if ($this->carRegistration()) {
            $criteria->addField("carRegistration", $this->carRegistration());
        }

        $criteria->setLimit(20);

        return $criteria;
    }

    /**
     * @return null
     */
    public function email()
    {
        return $this->email;
    }
}