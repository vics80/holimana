<?php

namespace Holimana\Infrastructure\Persistence;

class FilterCriteria
{
    /**
     * @var array
     */
    private $conditions = [];
    /**
     * @var array
     */
    private $fields = [];
    /**
     * @var string
     */
    private $orderBy;
    /**
     * @var string
     */
    private $orderByType = "DESC";
    /**
     * @var int
     */
    private $limit;
    /**
     * @var int
     */
    private $offset = 0;

    private $like;

    private $notIn;

    /**
     * @param $field
     * @param $target
     */
    public function addField($field, $target)
    {
        $this->fields[$field] = $target;
    }

    /**
     * @param $field
     * @param string $operator
     * @param $target
     */
    public function addCondition($field, $target, $operator = "=")
    {
        $this->conditions[] = new FilterCondition($field, $operator, $target);
    }

    /**
     * @param $field
     * @param string $type
     */
    public function setOrderBy($field, $type = "DESC")
    {
        $this->orderBy = $field;
        $this->orderByType = $type;
    }

    /**
     * @return array
     */
    public function conditions(): array
    {
        return $this->conditions;
    }

    /**
     * @return string
     */
    public function orderBy()
    {
        return $this->orderBy;
    }

    /**
     * @return string
     */
    public function orderByType()
    {
        return $this->orderByType;
    }

    /**
     * @return bool
     */
    public function limit()
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     */
    public function setLimit(int $limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return int
     */
    public function offset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     */
    public function setOffset(int $offset)
    {
        $this->offset = $offset;
    }

    public function setLike(array $like)
    {
        $this->like = $like;
    }

    public function like(): ?array
    {
        return $this->like;
    }

    public function notIn(): ?array
    {
        return $this->notIn;
    }

    /**
     * @param array $notIn
     */
    public function setNotIn(array $notIn)
    {
        $this->notIn = $notIn;
    }

    /**
     * @return array
     */
    public function fields(): array
    {
        return $this->fields;
    }

    public function toArray()
    {
        $result = [];
        /** @var FilterCondition $condition */
        foreach ($this->conditions() as $condition) {
            $result[$condition->field()] = $condition->target();
        }
        return $result;
    }
}