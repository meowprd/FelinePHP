<?php

namespace meowprd\FelinePHP\Http\Middleware\Handlers;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use meowprd\FelinePHP\Exceptions\Http\MethodNotAllowedException;
use meowprd\FelinePHP\Exceptions\Http\RouteNotFoundException;
use meowprd\FelinePHP\Http\Middleware\MiddlewareInterface;
use meowprd\FelinePHP\Http\Middleware\RequestHandlerInterface;
use meowprd\FelinePHP\Http\Request;
use meowprd\FelinePHP\Http\Response;
use function FastRoute\simpleDispatcher;

/**
 * Middleware for injecting route-specific middlewares into the request handler.
 *
 * This middleware processes the request through the router, matches the route,
 * and injects route-specific middlewares into the handler pipeline before
 * continuing with the request processing.
 */
class InjectRouteMiddlewares implements MiddlewareInterface
{
    /**
     * Process the HTTP request by routing it and injecting route-specific middlewares.
     *
     * @param Request $request The HTTP request to process
     * @param RequestHandlerInterface $handler The next handler in the pipeline
     * @return Response The HTTP response
     *
     * @throws MethodNotAllowedException If the HTTP method is not allowed for the route
     * @throws RouteNotFoundException If no matching route is found
     */
    public function process(Request $request, RequestHandlerInterface $handler): Response
    {
        $dispatcher = $this->registerRoutes();
        $routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());

        switch ($routeInfo[0]) {
            case Dispatcher::FOUND:
                [$status, $routeHandler, $vars] = $routeInfo;
                $request->setRouteHandler($routeHandler[0]);
                $request->setRouteVars($vars);
                $handler->injectMiddleware($routeHandler[1]);
                break;

            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = implode(', ', $routeInfo[1]);
                throw new MethodNotAllowedException("Supported methods are: $allowedMethods");

            case Dispatcher::NOT_FOUND:
            default:
                throw new RouteNotFoundException("Route not found");
        }

        return $handler->handle($request);
    }

    /**
     * Register application routes and create FastRoute dispatcher.
     *
     * @return Dispatcher Configured FastRoute dispatcher
     */
    private function registerRoutes(): Dispatcher
    {
        $webRoutes = require_once(ROOT_PATH . '/routes/web.php');
        $apiRoutes = require_once(ROOT_PATH . '/routes/api.php');

        return simpleDispatcher(function (RouteCollector $collector) use ($webRoutes, $apiRoutes) {
            foreach ($webRoutes as $webRoute) {
                $collector->addRoute(...$webRoute);
            }

            $collector->addGroup(API_PREFIX, function (RouteCollector $collector) use ($apiRoutes) {
                foreach ($apiRoutes as $apiRoute) {
                    $collector->addRoute(...$apiRoute);
                }
            });
        });
    }
}