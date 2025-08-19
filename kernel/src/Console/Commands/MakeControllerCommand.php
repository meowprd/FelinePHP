<?php

namespace meowprd\FelinePHP\Console\Commands;

// Define constants if not already defined
if (!defined('CONTROLLER_STUB_FILE')) {
    define('CONTROLLER_STUB_FILE', dirname(__FILE__) . '/stubs/controller.stub.php');
}

if (!defined('CONTROLLERS_PATH')) {
    define('CONTROLLERS_PATH', ROOT_PATH . '/app/Controllers');
}
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use meowprd\FelinePHP\Console\Colors;
use meowprd\FelinePHP\Console\CommandInterface;
use meowprd\FelinePHP\Exceptions\ConsoleException;

final class MakeControllerCommand implements CommandInterface
{
    /** @var string Command name */
    private string $command = 'make:controller';

    /** @var string Command description */
    private string $description = 'Create new controller template' . Colors::GRAY . ' (--name=IndexController)';

    public function __construct() {}

    /**
     * Execute the command.
     *
     * @param array $params Command parameters
     * @return int Exit code (0 on success)
     * @throws Exception
     * @throws \Throwable
     */
    public function execute(array $params = []): int
    {
        echo(Colors::LIGHT_CYAN . 'Running ' . $this->command . Colors::RESET . PHP_EOL);
        $this->validateParameters($params);
        $this->createControllerFile($params['name']);
        echo(Colors::LIGHT_GREEN . 'Controller created' . Colors::RESET . PHP_EOL);
        return 0;
    }

    /**
     * Validate required command parameters.
     *
     * @param array $params Command parameters
     * @throws ConsoleException If name parameter is missing
     */
    private function validateParameters(array $params): void
    {
        if (!isset($params['name'])) {
            throw new ConsoleException('Missing required parameter "name"');
        }
    }

    private function createControllerFile(string $controllerName): void {
        $path = CONTROLLERS_PATH . '/' . $controllerName . '.php';
        if(!file_exists(CONTROLLER_STUB_FILE)) throw new ConsoleException('Controller stub file not found: ' . CONTROLLER_STUB_FILE);
        if(file_exists($path)) throw new ConsoleException('Controller file already exists');

        $stub = file_get_contents(CONTROLLER_STUB_FILE);
        if($stub === false) throw new ConsoleException('Unable to read controller stub file: ' . CONTROLLER_STUB_FILE);
        if(!is_dir(CONTROLLERS_PATH)) mkdir(CONTROLLERS_PATH, 0755, true);

        $content = str_replace(
            ['{{ class }}'],
            [$controllerName],
            $stub
        );
        if(file_put_contents($path, $content) === false) {
            throw new ConsoleException('Unable to write controller file: ' . $path);
        }
    }
}