<?php

namespace App\Events;

use meowprd\FelinePHP\Event\Event;
use meowprd\FelinePHP\Http\Request;
use meowprd\FelinePHP\Http\Response;

class ExampleResponseEvent extends Event
{
    public function __construct(
        private readonly Request $request,
        private readonly Response $response
    ) {}

    public function request() { return $this->request; }
    public function response() { return $this->response; }
}