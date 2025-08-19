<?php

namespace meowprd\FelinePHP\Exceptions;

use Psr\Container\ContainerExceptionInterface;
use Throwable;

/**
 * Exception thrown when a container-related error occurs.
 *
 * This exception implements PSR-11 ContainerExceptionInterface and should be thrown
 * when errors occur during dependency resolution or container operations.
 */
class ContainerException extends \Exception implements ContainerExceptionInterface
{
    /**
     * @param string $message The exception message
     * @param int $code The exception code
     * @param Throwable|null $previous Previous exception for chaining
     */
    public function __construct(
        string $message = "",
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}