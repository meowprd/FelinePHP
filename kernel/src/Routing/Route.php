<?php

namespace meowprd\FelinePHP\Routing;

/**
 * Static factory class for creating HTTP routes.
 *
 * Provides a fluent interface for defining routes with HTTP methods, URIs,
 * handlers, and middleware. This class cannot be instantiated.
 */
final class Route
{
    /**
     * Private constructor to prevent instantiation.
     */
    private function __construct() {}

    /**
     * Create a GET route.
     *
     * @param string $uri The route URI pattern (e.g. '/users/{id}')
     * @param callable|array<string> $handler Route handler (callable or [Controller::class, 'method'])
     * @param array<string> $middleware Array of middleware class names
     * @return array{
     *     0: string,
     *     1: string,
     *     2: array{
     *         0: callable|array<string>,
     *         1: array<string>
     *     }
     * } Route definition array
     */
    public static function get(string $uri, array|callable $handler, array $middleware = []): array
    {
        return ['GET', $uri, [$handler, $middleware]];
    }

    /**
     * Create a POST route.
     *
     * @param string $uri The route URI pattern
     * @param callable|array<string> $handler Route handler
     * @param array<string> $middleware Array of middleware class names
     * @return array{
     *     0: string,
     *     1: string,
     *     2: array{
     *         0: callable|array<string>,
     *         1: array<string>
     *     }
     * } Route definition array
     */
    public static function post(string $uri, array|callable $handler, array $middleware = []): array
    {
        return ['POST', $uri, [$handler, $middleware]];
    }

    /**
     * Create a PUT route.
     *
     * @param string $uri The route URI pattern
     * @param callable|array<string> $handler Route handler
     * @param array<string> $middleware Array of middleware class names
     * @return array{
     *     0: string,
     *     1: string,
     *     2: array{
     *         0: callable|array<string>,
     *         1: array<string>
     *     }
     * } Route definition array
     */
    public static function put(string $uri, array|callable $handler, array $middleware = []): array
    {
        return ['PUT', $uri, [$handler, $middleware]];
    }

    /**
     * Create a DELETE route.
     *
     * @param string $uri The route URI pattern
     * @param callable|array<string> $handler Route handler
     * @param array<string> $middleware Array of middleware class names
     * @return array{
     *     0: string,
     *     1: string,
     *     2: array{
     *         0: callable|array<string>,
     *         1: array<string>
     *     }
     * } Route definition array
     */
    public static function delete(string $uri, array|callable $handler, array $middleware = []): array
    {
        return ['DELETE', $uri, [$handler, $middleware]];
    }

    /**
     * Create a PATCH route.
     *
     * @param string $uri The route URI pattern
     * @param callable|array<string> $handler Route handler
     * @param array<string> $middleware Array of middleware class names
     * @return array{
     *     0: string,
     *     1: string,
     *     2: array{
     *         0: callable|array<string>,
     *         1: array<string>
     *     }
     * } Route definition array
     */
    public static function patch(string $uri, array|callable $handler, array $middleware = []): array
    {
        return ['PATCH', $uri, [$handler, $middleware]];
    }

    /**
     * Create a route that matches any HTTP method.
     *
     * @param string $uri The route URI pattern
     * @param callable|array<string> $handler Route handler
     * @param array<string> $middleware Array of middleware class names
     * @return array{
     *     0: string,
     *     1: string,
     *     2: array{
     *         0: callable|array<string>,
     *         1: array<string>
     *     }
     * } Route definition array
     */
    public static function any(string $uri, array|callable $handler, array $middleware = []): array
    {
        return ['ANY', $uri, [$handler, $middleware]];
    }

    /**
     * Create a route that matches multiple HTTP methods.
     *
     * @param array<string> $methods Array of HTTP methods (e.g. ['GET', 'POST'])
     * @param string $uri The route URI pattern
     * @param callable|array<string> $handler Route handler
     * @param array<string> $middleware Array of middleware class names
     * @return array{
     *     0: array<string>,
     *     1: string,
     *     2: array{
     *         0: callable|array<string>,
     *         1: array<string>
     *     }
     * } Route definition array
     */
    public static function match(array $methods, string $uri, array|callable $handler, array $middleware = []): array
    {
        return [$methods, $uri, [$handler, $middleware]];
    }
}