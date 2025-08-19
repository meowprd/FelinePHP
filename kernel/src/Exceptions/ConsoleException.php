<?php

namespace meowprd\FelinePHP\Exceptions;

use meowprd\FelinePHP\Console\Colors;
use Throwable;

/**
 * Custom exception for console application errors.
 *
 * This exception handles fatal errors in console commands and provides colored output.
 */
class ConsoleException extends \Exception
{
    /**
     * @param string $message The error message
     * @param int $code The exception code
     * @param Throwable|null $previous Previous exception for chaining
     */
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->displayError($message);
    }

    /**
     * Displays the error message with colored output and terminates execution.
     *
     * @param string $message The error message to display
     */
    private function displayError(string $message): void
    {
        file_put_contents(
            'php://stderr',
            Colors::LIGHT_RED . '[FATAL ERROR]: ' . $message . Colors::RESET . PHP_EOL
        );
        exit(1);
    }
}