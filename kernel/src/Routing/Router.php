<?php

namespace meowprd\FelinePHP\Routing;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use League\Container\Container;
use meowprd\FelinePHP\Controller\AbstractController;
use meowprd\FelinePHP\Exceptions\Http\MethodNotAllowedException;
use meowprd\FelinePHP\Exceptions\Http\RouteNotFoundException;
use meowprd\FelinePHP\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use function FastRoute\simpleDispatcher;

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
     * @param Request   $request   The HTTP request object.
     * @param Container $container The DI container for resolving controllers.
     *
     * @return array{0: callable, 1: array} A tuple containing:
     *     - 0: The resolved handler (callable).
     *     - 1: An array of extracted route parameters.
     *
     * @throws MethodNotAllowedException       If the HTTP method is not allowed for the route.
     * @throws RouteNotFoundException          If no matching route is found.
     * @throws ContainerExceptionInterface     If the container fails to resolve a dependency.
     * @throws NotFoundExceptionInterface      If a required service is not found in the container.
     */
    public function dispatch(Request $request, Container $container): array
    {
        [$handler, $vars] = $this->extractRouteInfo($request);

        if (is_array($handler)) {
            [$controllerId, $method] = $handler;
            $controller = $container->get($controllerId);
            /** @var AbstractController $controller */
            $controller = new $controller();
            $controller->setContainer($container);
            $controller->setRequest($request);
            $handler = [$controller, $method];
        }

        return [$handler, $vars];
    }

    /**
     * Extracts the route handler and parameters for the given request.
     *
     * Loads route definitions from:
     * - `{ROOT_PATH}/routes/web.php`
     * - `{ROOT_PATH}/routes/api.php` (grouped under the `API_PREFIX`).
     *
     * @param Request $request The HTTP request to match.
     *
     * @return array{0: callable|array, 1: array} A tuple containing:
     *     - 0: The matched route handler (callable or [controller, method] array).
     *     - 1: An associative array of route parameters.
     *
     * @throws MethodNotAllowedException If the HTTP method is not allowed for the matched route.
     * @throws RouteNotFoundException    If no route matches the given request path.
     */
    private function extractRouteInfo(Request $request): array
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $collector) {
            $webRoutes = require_once(ROOT_PATH . '/routes/web.php');
            $apiRoutes = require_once(ROOT_PATH . '/routes/api.php');

            foreach ($webRoutes as $webRoute) {
                $collector->addRoute(...$webRoute);
            }

            $collector->addGroup(API_PREFIX, function (RouteCollector $collector) use ($apiRoutes) {
                foreach ($apiRoutes as $apiRoute) {
                    $collector->addRoute(...$apiRoute);
                }
            });
        });

        $routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());

        switch ($routeInfo[0]) {
            case Dispatcher::FOUND:
                return [$routeInfo[1], $routeInfo[2]];

            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = implode(', ', $routeInfo[1]);
                throw new MethodNotAllowedException("Supported methods are: $allowedMethods");

            case Dispatcher::NOT_FOUND:
            default:
                throw new RouteNotFoundException("Route not found");
        }
    }
}
