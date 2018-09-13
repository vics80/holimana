<?php

namespace Holimana\Domain\User;

interface UserRepository
{
    public function findAll(): UserCollection;

    public function findById(UserId $id): User;

    public function findBy(array $criteria): UserCollection;

    public function persist(User $user);
}