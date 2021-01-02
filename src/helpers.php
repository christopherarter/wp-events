<?php

use Dynamik\Services\EventService;

/**
 * Register events with their corresponding handlers.
 *
 * @param array $input
 * @return void
 */
function dk_events_register(array $input)
{
    $GLOBALS[EventService::GLOBAL_SERVICE_KEY] = new EventService($input);
}

/**
 * Dispatch an event to its registered handlers.
 *
 * @param string $eventName
 * @param mixed ...$args
 * @return void
 */
function dk_events_dispatch(string $eventName, ...$args)
{
    if ( array_key_exists(EventService::GLOBAL_SERVICE_KEY, $GLOBALS) && $GLOBALS[EventService::GLOBAL_SERVICE_KEY] instanceof EventService ) {
        $GLOBALS[EventService::GLOBAL_SERVICE_KEY]->dispatch($eventName, $args);
    }
}

