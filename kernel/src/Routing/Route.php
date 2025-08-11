<?php

namespace meowprd\FelinePHP\Routing;

/**
 * Static factory class for creating HTTP routes.
 *
 * Used to define routes by HTTP method, URI, and handler (callable or controller method).
 */
final class Route
{
    private function __construct() {}

    /**
     * Create a GET route.
     *
     * @param string                 $uri     The route URI (e.g. '/users')
     * @param callable|array<string> $handler Callable or array [ControllerClass::class, 'method']
     *
     * @return array{0: string, 1: string, 2: callable|array<string>} Route definition array
     */
    public static function get(string $uri, array|callable $handler): array
    {
        return ['GET', $uri, $handler];
    }

    /**
     * Create a POST route.
     *
     * @param string                 $uri     The route URI
     * @param callable|array<string> $handler The handler
     *
     * @return array{0: string, 1: string, 2: callable|array<string>} Route definition array
     */
    public static function post(string $uri, array|callable $handler): array
    {
        return ['POST', $uri, $handler];
    }

    /**
     * Create a PUT route.
     *
     * @param string                 $uri     The route URI
     * @param callable|array<string> $handler The handler
     *
     * @return array{0: string, 1: string, 2: callable|array<string>} Route definition array
     */
    public static function put(string $uri, array|callable $handler): array
    {
        return ['PUT', $uri, $handler];
    }

    /**
     * Create a DELETE route.
     *
     * @param string                 $uri     The route URI
     * @param callable|array<string> $handler The handler
     *
     * @return array{0: string, 1: string, 2: callable|array<string>} Route definition array
     */
    public static function delete(string $uri, array|callable $handler): array
    {
        return ['DELETE', $uri, $handler];
    }

    /**
     * Create a PATCH route.
     *
     * @param string                 $uri     The route URI
     * @param callable|array<string> $handler The handler
     *
     * @return array{0: string, 1: string, 2: callable|array<string>} Route definition array
     */
    public static function patch(string $uri, array|callable $handler): array
    {
        return ['PATCH', $uri, $handler];
    }
}
