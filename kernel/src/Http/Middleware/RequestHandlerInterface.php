<?php

namespace meowprd\FelinePHP\Http\Middleware;

use meowprd\FelinePHP\Http\Request;
use meowprd\FelinePHP\Http\Response;

/**
 * Interface for request handlers in the middleware pipeline.
 *
 * Request handlers process HTTP requests and return responses.
 * This interface defines the contract for components that can handle
 * requests in the middleware stack.
 */
interface RequestHandlerInterface
{
    /**
     * Handle an incoming HTTP request.
     *
     * Processes the request and returns an appropriate HTTP response.
     * This method is the entry point for request processing in the middleware pipeline.
     *
     * @param Request $request The HTTP request to handle
     * @return Response The HTTP response
     */
    public function handle(Request $request): Response;
}