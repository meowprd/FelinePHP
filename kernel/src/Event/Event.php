<?php

namespace meowprd\FelinePHP\Event;

use Psr\EventDispatcher\StoppableEventInterface;

/**
 * Base event class implementing PSR-14 StoppableEventInterface.
 *
 * Provides foundation for all events in the event dispatcher system.
 * Events can stop propagation to prevent further listeners from being called.
 */
abstract class Event implements StoppableEventInterface
{
    /**
     * @var bool Whether event propagation is stopped
     */
    private bool $stopped = false;

    /**
     * Check whether event propagation is stopped.
     *
     * Returns true if the event propagation has been stopped, false otherwise.
     * When propagation is stopped, no further listeners will be called.
     *
     * @return bool True if propagation is stopped, false otherwise
     */
    public function isPropagationStopped(): bool
    {
        return $this->stopped;
    }

    /**
     * Stop the propagation of the event.
     *
     * Prevents any further listeners from being called for this event.
     * This method is typically called from within an event listener.
     *
     * @return void
     */
    public function stopPropagation(): void
    {
        $this->stopped = true;
    }
}