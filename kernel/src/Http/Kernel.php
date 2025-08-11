<?php

namespace meowprd\FelinePHP\Http;

use meowprd\FelinePHP\Exceptions\HttpException;
use meowprd\FelinePHP\Routing\Router;

/**
 * Application kernel.
 *
 * The kernel is responsible for handling an incoming HTTP request
 * and producing an HTTP response.
 */
readonly class Kernel
{
    /**
     * @param Router $router Router instance used for dispatching requests.
     */
    public function __construct(
        private readonly Router $router
    ) {}

    /**
     * Handles an HTTP request and returns a response.
     *
     * Dispatches the request through the router, invokes the matched handler,
     * and returns the resulting Response. If an exception occurs, returns
     * a Response containing the error message and code.
     *
     * @param Request $request The HTTP request object.
     * @return Response The HTTP response object.
     * @throws \Throwable
     */
    public function handle(Request $request): Response
    {
        try {
            [$handler, $vars] = $this->router->dispatch($request);
            $response = call_user_func_array($handler, $vars);
        } catch(\Throwable $e) {
            return $this->handleException($e);
        }
        return $response;
    }

    private function handleException(\Throwable $exception): Response {
        if(defined('DEBUG') && DEBUG) {
            throw $exception;
        }

        if($exception instanceof HttpException) {
            return $exception->handle();
        }

        return new Response($exception->getMessage(), $exception->getCode());
    }
}
