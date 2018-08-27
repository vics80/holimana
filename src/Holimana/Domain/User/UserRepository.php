<?php

namespace Holimana\Domain\User;

interface UserRepository
{
    public function findAll();

    public function findById(UserId $id): User;

    public function findBy(array $criteria);

    public function persist(User $card);
}