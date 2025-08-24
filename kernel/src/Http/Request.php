<?php

namespace meowprd\FelinePHP\Http;

/**
 * Immutable HTTP request object.
 *
 * Provides read-only access to the PHP superglobals ($_GET, $_POST, $_FILES, $_COOKIE, $_SERVER)
 * for representing an HTTP request in an object-oriented way.
 *
 * @final
 */
final class Request
{
    /** @var Session $session */
    private Session $session;

    /** @var mixed $routeHandler */
    private mixed $routeHandler;

    /** @var array<string, mixed> $routeVars */
    private array $routeVars;

    /**
     * @param array<string, mixed> $get     HTTP GET parameters (usually from $_GET)
     * @param array<string, mixed> $post    HTTP POST parameters (usually from $_POST)
     * @param array<string, mixed> $files   Uploaded files information (usually from $_FILES)
     * @param array<string, mixed> $cookies HTTP cookies (usually from $_COOKIE)
     * @param array<string, mixed> $server  Server and execution environment information (usually from $_SERVER)
     */
    public function __construct(
        private array $get,
        private array $post,
        private array $files,
        private array $cookies,
        private array $server,
    ) {}

    /**
     * Create a Request instance from PHP superglobals.
     *
     * @return static
     */
    public static function createFromGlobals(): static
    {
        return new static($_GET, $_POST, $_FILES, $_COOKIE, $_SERVER);
    }

    /**
     * Returns the HTTP method of the request.
     *
     * @return string The request method (e.g., GET, POST, PUT, DELETE).
     */
    public function getMethod(): string
    {
        return strtoupper($this->server['REQUEST_METHOD'] ?? 'GET');
    }

    /**
     * Returns the request URI.
     *
     * @return string The URI path and query string (without scheme/host).
     */
    public function getUri(): string
    {
        return $this->server['REQUEST_URI'] ?? '/';
    }

    /**
     * Returns the request path without query string.
     *
     * @return string The URI path only.
     */
    public function getPath(): string
    {
        $uri = $this->getUri();
        $path = parse_url($uri, PHP_URL_PATH);
        return $path ?: '/';
    }

    /**
     * Returns the GET query parameters.
     *
     * @return array<string, mixed>
     */
    public function getQueryParams(): array
    {
        return $this->get;
    }

    /**
     * Returns the POST parameters.
     *
     * @return array<string, mixed>
     */
    public function getPostParams(): array
    {
        return $this->post;
    }

    /**
     * Returns a specific HTTP header by name.
     *
     * Header name is case-insensitive.
     *
     * @param string $name    Header name (e.g. 'Content-Type').
     * @param mixed  $default Default value if header is not found.
     * @return string|mixed
     */
    public function getHeader(string $name, mixed $default = null): mixed
    {
        $key = 'HTTP_' . strtoupper(str_replace('-', '_', $name));
        if (isset($this->server[$key])) {
            return $this->server[$key];
        }
        // Special cases for some headers not prefixed with HTTP_
        $specialHeaders = [
            'CONTENT_TYPE' => 'CONTENT_TYPE',
            'CONTENT_LENGTH' => 'CONTENT_LENGTH',
            'AUTHORIZATION' => 'REDIRECT_HTTP_AUTHORIZATION',
        ];
        $upperName = strtoupper(str_replace('-', '_', $name));
        if (isset($specialHeaders[$upperName]) && isset($this->server[$specialHeaders[$upperName]])) {
            return $this->server[$specialHeaders[$upperName]];
        }
        return $default;
    }

    /**
     * Returns all HTTP headers as an associative array.
     *
     * Header names are normalized to their typical case with dashes.
     *
     * @return array<string, string> Array of headers ['Content-Type' => 'application/json', ...]
     */
    public function getHeaders(): array
    {
        $headers = [];
        foreach ($this->server as $key => $value) {
            if (str_starts_with($key, 'HTTP_')) {
                $header = substr($key, 5);
                $header = str_replace('_', ' ', strtolower($header));
                $header = str_replace(' ', '-', ucwords($header));
                $headers[$header] = $value;
            } elseif (in_array($key, ['CONTENT_TYPE', 'CONTENT_LENGTH', 'CONTENT_MD5'])) {
                $header = str_replace('_', ' ', strtolower($key));
                $header = str_replace(' ', '-', ucwords($header));
                $headers[$header] = $value;
            }
        }
        return $headers;
    }

    /**
     * Set the session instance.
     *
     * @param Session $session Session instance to set
     * @return self Returns instance for method chaining
     */
    public function setSession(Session $session): self
    {
        $this->session = $session;
        return $this;
    }

    /**
     * Get the session instance.
     *
     * @return Session Current session instance
     * @throws \RuntimeException If session has not been set
     */
    public function session(): Session
    {
        if (!isset($this->session)) {
            throw new \RuntimeException('Session has not been initialized');
        }

        return $this->session;
    }

    /**
     * Get route variables extracted from the URI.
     *
     * @return array<string, mixed> Route parameters
     */
    public function routeVars(): array
    {
        return $this->routeVars;
    }

    /**
     * Set route variables extracted from the URI.
     *
     * @param array<string, mixed> $routeVars Route parameters
     * @return self
     */
    public function setRouteVars(array $routeVars): self
    {
        $this->routeVars = $routeVars;
        return $this;
    }

    /**
     * Get the route handler callable.
     *
     * @return mixed Route handler (callable or controller specification)
     */
    public function routeHandler(): mixed
    {
        return $this->routeHandler;
    }

    /**
     * Set the route handler callable.
     *
     * @param mixed $routeHandler Route handler (callable or controller specification)
     * @return self
     */
    public function setRouteHandler(mixed $routeHandler): self
    {
        $this->routeHandler = $routeHandler;
        return $this;
    }
}