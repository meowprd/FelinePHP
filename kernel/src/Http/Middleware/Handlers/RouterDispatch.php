<?php

namespace meowprd\FelinePHP\Http\Middleware\Handlers;

use League\Container\Container;
use meowprd\FelinePHP\Http\Middleware\MiddlewareInterface;
use meowprd\FelinePHP\Http\Middleware\RequestHandlerInterface;
use meowprd\FelinePHP\Http\Request;
use meowprd\FelinePHP\Http\Response;
use meowprd\FelinePHP\Routing\Router;
use Rakit\Validation\Validator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Middleware for dispatching routes through the router.
 *
 * This middleware is typically placed at the end of the middleware pipeline.
 * It uses the router to resolve the route handler and executes it with
 * the appropriate parameters.
 *
 * @final
 */
final class RouterDispatch implements MiddlewareInterface
{
    /**
     * Constructor.
     *
     * @param Router $router Router instance for route resolution
     * @param Container $container Dependency injection container
     * @param Validator $validator Validation service
     */
    public function __construct(
        private readonly Router $router,
        private readonly Container $container,
        private readonly Validator $validator
    ) {}

    /**
     * Process the request by dispatching it to the appropriate route handler.
     *
     * @param Request $request The HTTP request to process
     * @param RequestHandlerInterface $handler The next handler in the pipeline
     * @return Response The HTTP response from the route handler
     *
     * @throws ContainerExceptionInterface If the handler cannot be resolved from container
     * @throws NotFoundExceptionInterface If the handler class is not found
     * @throws \InvalidArgumentException If the handler is not callable
     */
    public function process(Request $request, RequestHandlerInterface $handler): Response
    {
        [$routeHandler, $vars] = $this->router->dispatch($request, $this->container, $this->validator);

        if (!is_callable($routeHandler)) {
            throw new \InvalidArgumentException('Route handler must be callable');
        }

        return call_user_func_array($routeHandler, $vars);
    }
}