<?php

namespace meowprd\FelinePHP\Http;

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

/**
 * Application kernel.
 *
 * The kernel is responsible for handling an incoming HTTP request
 * and producing an HTTP response.
 */
class Kernel
{
    /**
     * Handles an HTTP request and returns a response.
     *
     * @param Request $request The HTTP request object.
     * @return Response The HTTP response object.
     */
    public function handle(Request $request): Response
    {
        $dispatcher = simpleDispatcher(function(RouteCollector $collector) {

            $webRoutes = require_once(ROOT_PATH . '/routes/web.php');
            $apiRoutes = require_once(ROOT_PATH . '/routes/api.php');

            foreach ($webRoutes as $webRoute) { $collector->addRoute(...$webRoute); }
            $collector->addGroup(API_PREFIX, function(RouteCollector $collector) use ($apiRoutes) {
                foreach ($apiRoutes as $apiRoute) { $collector->addRoute(...$apiRoute); }
            });
        });

        $routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());
        [$status, $handler, $vars] = $routeInfo;
        return $handler($vars);
    }
}
