<?php

namespace App\Middlewares;

use meowprd\FelinePHP\Http\Middleware\MiddlewareInterface;
use meowprd\FelinePHP\Http\Middleware\RequestHandlerInterface;
use meowprd\FelinePHP\Http\Request;
use meowprd\FelinePHP\Http\Response;

class TestMiddleware implements MiddlewareInterface
{

    /**
     * @inheritDoc
     */
    public function process(Request $request, RequestHandlerInterface $handler): Response
    {
        dump('test middleware');
        return $handler->handle($request);
    }
}