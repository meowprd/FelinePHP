<?php

namespace meowprd\FelinePHP\Console;

/**
 * Interface for console commands.
 *
 * Any console command should implement this interface to be executable
 * by the application's CLI kernel.
 */
interface CommandInterface
{
    /**
     * Execute the console command.
     *
     * @param array $params Optional parameters passed to the command.
     * @return int Exit code (0 for success, non-zero for errors).
     */
    public function execute(array $params = []): int;
}
