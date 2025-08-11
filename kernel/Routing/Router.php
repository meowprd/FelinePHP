<?php

namespace meowprd\FelinePHP\Routing;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use meowprd\FelinePHP\Exceptions\Http\MethodNotAllowedException;
use meowprd\FelinePHP\Exceptions\Http\RouteNotFoundException;
use meowprd\FelinePHP\Http\Request;
use function FastRoute\simpleDispatcher;

class Router
{
    /**
     * Dispatch the request to the appropriate route handler.
     *
     * @param Request $request
     * @return array{0: callable|array, 1: array} [handler, route parameters]
     *
     * @throws MethodNotAllowedException If HTTP method not allowed
     * @throws RouteNotFoundException If route not found
     */
    public function dispatch(Request $request): array {
        [$handler, $vars] = $this->extractRouteInfo($request);
        if(is_array($handler)) {
            [$controller, $method] = $handler;
            $handler = [new $controller, $method];
        }
        return array($handler, $vars);
    }

    /**
     * Extract route handler and parameters from the request.
     *
     * @param Request $request
     * @return array{0: callable|array, 1: array} [handler, route parameters]
     *
     * @throws MethodNotAllowedException If HTTP method not allowed
     * @throws RouteNotFoundException If route not found
     */
    private function extractRouteInfo(Request $request): array {
        $dispatcher = simpleDispatcher(function(RouteCollector $collector) {

            $webRoutes = require_once(ROOT_PATH . '/routes/web.php');
            $apiRoutes = require_once(ROOT_PATH . '/routes/api.php');

            foreach ($webRoutes as $webRoute) { $collector->addRoute(...$webRoute); }
            $collector->addGroup(API_PREFIX, function(RouteCollector $collector) use ($apiRoutes) {
                foreach ($apiRoutes as $apiRoute) { $collector->addRoute(...$apiRoute); }
            });
        });

        $routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());

        switch($routeInfo[0]) {
            case Dispatcher::FOUND:
                return array($routeInfo[1], $routeInfo[2]);
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = implode(', ', $routeInfo[1]);
                throw new MethodNotAllowedException("Supported methods are: $allowedMethods");
            default:
            case Dispatcher::NOT_FOUND:
                throw new RouteNotFoundException("Route not found");
        }
    }
}
