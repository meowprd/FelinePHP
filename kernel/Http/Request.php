<?php

namespace meowprd\FelinePHP\Http;

/**
 * Immutable HTTP request object.
 *
 * This class provides read-only access to the PHP superglobals ($_GET, $_POST, $_FILES, $_COOKIE, $_SERVER)
 * for representing an HTTP request in an object-oriented way.
 *
 * @readonly
 */
readonly class Request
{
    /**
     * @param array<string, mixed> $get     HTTP GET parameters (usually from $_GET)
     * @param array<string, mixed> $post    HTTP POST parameters (usually from $_POST)
     * @param array<string, mixed> $files   Uploaded files information (usually from $_FILES)
     * @param array<string, mixed> $cookies HTTP cookies (usually from $_COOKIE)
     * @param array<string, mixed> $server  Server and execution environment information (usually from $_SERVER)
     */
    public function __construct(
        private readonly array $get,
        private readonly array $post,
        private readonly array $files,
        private readonly array $cookies,
        private readonly array $server,
    ) {}

    /**
     * Create a Request instance from PHP superglobals.
     *
     * @return static New Request object with current global state.
     */
    public static function createFromGlobals(): static {
        return new static($_GET, $_POST, $_FILES, $_COOKIE, $_SERVER);
    }
}
