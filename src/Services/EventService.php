<?php 

namespace Dynamik\Services;

use Dynamik\Exceptions\FunctionNotFoundException;

class EventService
{

    /**
     * Events this service handles
     *
     * @var array
     */
    public $events;

    const GLOBAL_SERVICE_KEY = 'wp_events';

    public function __construct(array $array)
    {
        $this->events = $array;
    }

    /**
     * Dispatch the event
     *
     * @param string $eventName
     * @param mixed ...$args
     * @return void
     */
    public function dispatch(string $eventName, $args)
    {
        if ( $this->eventCallable($eventName) ) {
            $this->dispatchEvents($eventName, $args);
        }
    }

    /**
     * Determine if the event is valid and callable.
     *
     * @return bool
     */
    protected function eventCallable($eventName)
    {
        return array_key_exists($eventName, $this->events);
    }

    /**
     * Dispatch this Event Service events
     *
     * @param string $eventName
     * @param mixed $args
     * @return void
     */
    protected function dispatchEvents(string $eventName, $args)
    {
        foreach ( $this->events[$eventName] as $listener ) {
            $this->callListener($listener, $args);
        }
    }

    /**
     * Call the given listener.
     *
     * @param string|array $listener
     * @param array $args
     * @return void
     */
    protected function callListener($listener, $args)
    {
        if(! function_exists($listener) )
        {
            throw new FunctionNotFoundException($listener);
        } else {
            call_user_func($listener, ...$args );
        }
    }
}