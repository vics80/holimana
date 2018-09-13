<?php
/**
 * Created by PhpStorm.
 * User: vigarcia
 * Date: 30/08/18
 * Time: 9:28
 */

namespace Holimana\Domain;

use Holimana\Domain\Event\DomainEvent;
use Holimana\Domain\Event\EventPublisher;

class DomainEventPublisher implements EventPublisher
{
    /**
     * @var DomainEventSubscriber[]
     */
    private $subscribers;


    /**
     * @var DomainEventPublisher
     */
    private static $instance = null;

    public static function instance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function __construct()
    {
        $this->subscribers = [];
    }

    public function __clone()
    {
        throw new \BadMethodCallException("Clone is not supported");
    }

    public function subscribe($aDomainEventSubscriber)
    {
        static::instance()->subscribers[] = $aDomainEventSubscriber;
    }

    public function publish(DomainEvent $anEvent)
    {
        echo count($this->subscribers);
        foreach ($this->subscribers as $aSubscriber) {
            if ($aSubscriber->isSubscribedTo($anEvent)) {
                $aSubscriber->handle($anEvent);
            }
        }
    }

    public function publishSync(DomainEvent $event)
    {
        // TODO: Implement publishSync() method.
    }

    public function dispatch(DomainEvent $event)
    {
        // TODO: Implement dispatch() method.
    }

    public function unsubscribe($id)
    {
        // TODO: Implement unsubscribe() method.
    }
}