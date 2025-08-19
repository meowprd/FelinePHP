<?php

namespace meowprd\FelinePHP\Exceptions;

use meowprd\FelinePHP\Console\Colors;
use Throwable;

class ConsoleException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        echo(
            Colors::LIGHT_RED . '[FATAL ERROR]: ' . $message . Colors::RESET . PHP_EOL
        );
        exit(1);
    }
}