<?php

namespace App\EventListeners;

use App\Events\ExampleResponseEvent;

class ExampleEventListener
{
    public function __invoke(ExampleResponseEvent $event)
    {
        dump('ExampleEventListener invoked');
        dd($event);
    }
}