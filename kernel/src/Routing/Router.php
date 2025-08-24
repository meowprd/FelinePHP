<?php

namespace meowprd\FelinePHP\Routing;

use League\Container\Container;
use meowprd\FelinePHP\Controller\AbstractController;
use meowprd\FelinePHP\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Rakit\Validation\Validator;

/**
 * Router service for dispatching HTTP requests to their corresponding handlers.
 *
 * This class uses FastRoute for routing and integrates with a dependency
 * injection container to resolve controller instances.
 */
class Router
{
    /**
     * Dispatches an HTTP request to its associated route handler.
     *
     * If the resolved handler is specified as an array `[ControllerClass, method]`,
     * the controller instance is retrieved from the container before invocation.
     *
     * @param Request $request The HTTP request object
     * @param Container $container The DI container for resolving controllers
     * @param Validator $validator The validation service
     * @return array{0: callable, 1: array} A tuple containing:
     *     - 0: The resolved handler (callable)
     *     - 1: An array of extracted route parameters
     *
     * @throws ContainerExceptionInterface If the container fails to resolve a dependency
     * @throws NotFoundExceptionInterface If a required service is not found in the container
     */
    public function dispatch(Request $request, Container $container, Validator $validator): array
    {
        $handler = $request->routeHandler();
        $vars = $request->routeVars();

        if (is_array($handler)) {
            [$controllerId, $method] = $handler;
            $controller = $container->get($controllerId);
            if (is_subclass_of($controller, AbstractController::class)) {
                $controller->setContainer($container);
                $controller->setRequest($request);
                $controller->setValidator($validator);
            }
            $handler = [$controller, $method];
        }

        return [$handler, $vars];
    }
}