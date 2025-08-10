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
            $collector->get('/', function() {
                $content = 'hello, world!';
                return new Response($content);
            });

            $collector->get('/user/{id}', function(array $vars){
                $content = "user = {$vars['id']}";
                return new Response($content);
            });
        });

        $routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());
        [$status, $handler, $vars] = $routeInfo;
        return $handler($vars);
    }
}
