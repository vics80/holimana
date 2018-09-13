<?php

namespace Holimana\Application\Service;


interface PasswordHasher
{
    public function generate($plainPassword);
}