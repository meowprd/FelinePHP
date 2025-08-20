<?php

namespace meowprd\FelinePHP\Http\Middleware;

use League\Container\Container;
use meowprd\FelinePHP\Http\Middleware\Handlers\RouterDispatch;
use meowprd\FelinePHP\Http\Middleware\Handlers\StartSession;
use meowprd\FelinePHP\Http\Request;
use meowprd\FelinePHP\Http\Response;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Request handler implementation for processing middleware pipelines.
 *
 * This class manages a stack of middleware classes and processes them sequentially.
 * It uses dependency injection container to resolve middleware instances.
 */
class RequestHandler implements RequestHandlerInterface
{
    /**
     * @var array<string> Middleware class names stack
     */
    private array $middleware = [
        StartSession::class,
        RouterDispatch::class
    ];

    /**
     * Constructor.
     *
     * @param Container $container Dependency injection container
     */
    public function __construct(
        private readonly Container $container
    ) {}

    /**
     * Handle an incoming HTTP request through the middleware pipeline.
     *
     * Processes the middleware stack sequentially. Each middleware is resolved
     * from the container and invoked with the current request and itself as next handler.
     *
     * @param Request $request The HTTP request to handle
     * @return Response The HTTP response
     *
     * @throws ContainerExceptionInterface If middleware cannot be resolved from container
     * @throws NotFoundExceptionInterface If middleware class is not found in container
     */
    public function handle(Request $request): Response
    {
        if (empty($this->middleware)) {
            return new Response('Server error: No middleware configured', 500);
        }

        $middlewareClass = array_shift($this->middleware);
        $middleware = $this->container->get($middlewareClass);

        return $middleware->process($request, $this);
    }

    /**
     * Inject middleware into the pipeline.
     *
     * Adds middleware classes to the beginning of the processing stack.
     * Useful for adding global middleware or conditionally adding middleware.
     *
     * @param array<string> $middleware Array of middleware class names
     * @return void
     */
    public function injectMiddleware(array $middleware): void
    {
        array_splice($this->middleware, 0, 0, $middleware);
    }

    /**
     * Add middleware to the end of the pipeline.
     *
     * @param string $middlewareClass Middleware class name
     * @return self
     */
    public function addMiddleware(string $middlewareClass): self
    {
        $this->middleware[] = $middlewareClass;
        return $this;
    }

    /**
     * Set the entire middleware stack.
     *
     * @param array<string> $middleware Array of middleware class names
     * @return self
     */
    public function setMiddleware(array $middleware): self
    {
        $this->middleware = $middleware;
        return $this;
    }

    /**
     * Get the current middleware stack.
     *
     * @return array<string> Array of middleware class names
     */
    public function getMiddleware(): array
    {
        return $this->middleware;
    }

    /**
     * Clear the middleware stack.
     *
     * @return self
     */
    public function clearMiddleware(): self
    {
        $this->middleware = [];
        return $this;
    }

    /**
     * Check if middleware stack is empty.
     *
     * @return bool True if no middleware is configured
     */
    public function isEmpty(): bool
    {
        return empty($this->middleware);
    }

    /**
     * Get the number of middleware in the stack.
     *
     * @return int Count of middleware
     */
    public function count(): int
    {
        return count($this->middleware);
    }
}