<?php

namespace meowprd\FelinePHP\Http;

use League\Container\Container;
use meowprd\FelinePHP\Exceptions\HttpException;
use meowprd\FelinePHP\Http\Middleware\RequestHandlerInterface;
use meowprd\FelinePHP\Routing\Router;

/**
 * Application kernel.
 *
 * The Kernel coordinates the handling of incoming HTTP requests
 * by dispatching them through the router, invoking the matched handler,
 * and returning an HTTP response.
 *
 * It also provides a centralized exception handling mechanism to
 * convert errors into valid HTTP responses or rethrow them in debug mode.
 */
readonly class Kernel
{
    /**
     * Creates a new Kernel instance.
     *
     * @param RequestHandlerInterface $requestHandler Middlewares runner
     */
    public function __construct(
        private readonly RequestHandlerInterface $requestHandler,
    ) {}

    /**
     * Handles an HTTP request and returns a response.
     *
     * The method delegates routing to the Router, executes the resolved
     * request handler, and returns its response.
     * If an exception is thrown, it is passed to {@see Kernel::handleException()}.
     *
     * @param Request $request The HTTP request object.
     * @return Response The HTTP response produced by the handler or generated from an exception.
     * @throws \Throwable Rethrows the original exception when DEBUG mode is enabled.
     */
    public function handle(Request $request): Response
    {
        try {
            $response = $this->requestHandler->handle($request);
        } catch (\Throwable $e) {
            return $this->handleException($e);
        }

        return $response;
    }

    /**
     * Handles exceptions and converts them into HTTP responses.
     *
     * - In DEBUG mode, the original exception is rethrown.
     * - If the exception is an HttpException, it delegates handling to {@see HttpException::handle()}.
     * - Otherwise, it returns a generic response with the exception's message and code.
     *
     * @param \Throwable $exception The thrown exception.
     * @return Response The HTTP response representing the error.
     * @throws \Throwable If DEBUG mode is enabled, rethrows the exception.
     */
    private function handleException(\Throwable $exception): Response
    {
        if ($_ENV['DEBUG']) {
            throw $exception;
        }

        if ($exception instanceof HttpException) {
            return $exception->handle();
        }

        return new Response($exception->getMessage(), $exception->getCode());
    }
}
