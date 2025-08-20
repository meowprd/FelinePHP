<?php

namespace meowprd\FelinePHP\Http\Middleware;

use meowprd\FelinePHP\Http\Request;
use meowprd\FelinePHP\Http\Response;

/**
 * Interface for middleware components in the HTTP request processing pipeline.
 *
 * Middleware components process HTTP requests and responses, potentially
 * modifying them or short-circuiting the pipeline. They can perform tasks
 * such as authentication, logging, CORS handling, etc.
 */
interface MiddlewareInterface
{
    /**
     * Process an incoming HTTP request.
     *
     * Middleware components can:
     * - Modify the request before passing it to the handler
     * - Modify the response returned by the handler
     * - Short-circuit the pipeline and return a response directly
     * - Perform side effects (logging, metrics, etc.)
     *
     * @param Request $request The HTTP request to process
     * @param RequestHandlerInterface $handler The next handler in the pipeline
     * @return Response The HTTP response
     */
    public function process(Request $request, RequestHandlerInterface $handler): Response;
}