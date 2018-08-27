<?php

namespace Holimana\Domain;

interface DomainRepository
{
    public function beginTransaction();

    public function rollback();
}