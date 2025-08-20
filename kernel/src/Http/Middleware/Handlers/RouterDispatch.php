<?php

namespace meowprd\FelinePHP\Http\Middleware\Handlers;

use League\Container\Container;
use meowprd\FelinePHP\Http\Middleware\MiddlewareInterface;
use meowprd\FelinePHP\Http\Middleware\RequestHandlerInterface;
use meowprd\FelinePHP\Http\Request;
use meowprd\FelinePHP\Http\Response;
use meowprd\FelinePHP\Routing\Router;

class RouterDispatch implements MiddlewareInterface
{
    public function __construct(
        private readonly Router $router,
        private readonly Container $container
    ) {}

    public function process(Request $request, RequestHandlerInterface $handler): Response
    {
        [$handler, $vars] = $this->router->dispatch($request, $this->container);
        return call_user_func_array($handler, $vars);
    }
}