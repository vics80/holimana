<?php

namespace Holimana\Infrastructure\Event;


interface EventProducerFactory
{
    public function get($queueService);
}