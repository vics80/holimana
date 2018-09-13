<?php

namespace Holimana\Domain\Day;

interface DayRepository
{
    public function findAll(): DayCollection;

    public function findById(DayId $id): Day;

    public function findBy(array $criteria): DayCollection;

    public function persist(Day $day);
}