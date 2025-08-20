<?php

namespace meowprd\FelinePHP\Http\Middleware\Handlers;

use meowprd\FelinePHP\Http\Middleware\MiddlewareInterface;
use meowprd\FelinePHP\Http\Middleware\RequestHandlerInterface;
use meowprd\FelinePHP\Http\Request;
use meowprd\FelinePHP\Http\Response;
use meowprd\FelinePHP\Http\Session;

class StartSession implements MiddlewareInterface
{
    public function __construct(
        private readonly Session $session,
    ) {}

    public function process(Request $request, RequestHandlerInterface $handler): Response
    {
        $this->session->start();
        $request->setSession($this->session);
        return $handler->handle($request);
    }
}