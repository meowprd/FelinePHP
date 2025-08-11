<?php

namespace meowprd\FelinePHP\Debug;

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

/**
 * Debugger class responsible for registering
 * error handlers like Whoops based on debug mode.
 */
class WhoopsDebugger
{
    /**
     * Registers the Whoops error handler if debugging is enabled.
     *
     * @param bool $debug Indicates whether debugging is enabled.
     * @return void
     */
    public static function register(bool $debug): void
    {
        if (!$debug) {
            return;
        }

        $whoops = new Run();
        $whoops->pushHandler(new PrettyPageHandler());
        $whoops->register();
    }
}
