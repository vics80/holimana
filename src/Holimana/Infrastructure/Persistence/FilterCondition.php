<?php

namespace Holimana\Infrastructure\Persistence;


class FilterCondition
{
    private $field;
    private $operator;
    private $target;

    public function __construct($field, $operator, $target)
    {
        $this->field = $field;
        $this->operator = $operator;
        $this->target = $target;
    }

    /**
     * @return mixed
     */
    public function field()
    {
        return $this->field;
    }

    /**
     * @return mixed
     */
    public function operator()
    {
        return $this->operator;
    }

    /**
     * @return mixed|array
     */
    public function target()
    {
        return $this->target;
    }

    public function toArray()
    {
        return [
            $this->field() => $this->target()
        ];
    }
}