<?php

namespace meowprd\FelinePHP\Event;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\StoppableEventInterface;

/**
 * PSR-14 compliant event dispatcher implementation.
 *
 * Provides a simple event dispatcher that allows registering listeners
 * and dispatching events to those listeners.
 */
class EventDispatcher implements EventDispatcherInterface
{
    /**
     * @var array<string, array<callable>> Registered event listeners
     */
    private array $listeners = [];

    /**
     * Dispatch an event to all registered listeners.
     *
     * @param object $event The event to dispatch
     * @return object The dispatched event
     */
    public function dispatch(object $event): object
    {
        foreach ($this->getListenersForEvent($event) as $listener) {
            if ($event instanceof StoppableEventInterface && $event->isPropagationStopped()) {
                return $event;
            }
            $listener($event);
        }
        return $event;
    }

    /**
     * Add a listener for a specific event.
     *
     * @param string $event Event class name to listen for
     * @param callable $listener Callable to execute when event is dispatched
     * @return self Returns instance for method chaining
     */
    public function addListener(string $event, callable $listener): self
    {
        $this->listeners[$event][] = $listener;
        return $this;
    }

    /**
     * Get all listeners for a given event.
     *
     * @param object $event Event instance
     * @return iterable<callable> Iterable of listeners for the event
     */
    public function getListenersForEvent(object $event): iterable
    {
        $eventClass = get_class($event);
        return $this->listeners[$eventClass] ?? [];
    }
}