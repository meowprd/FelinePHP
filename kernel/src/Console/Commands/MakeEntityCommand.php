<?php

namespace meowprd\FelinePHP\Console\Commands;

// Define constants if not already defined
if (!defined('ENTITY_STUB_FILE')) {
    define('ENTITY_STUB_FILE', dirname(__FILE__) . '/stubs/entity.stub.php');
}

if (!defined('ENTITIES_PATH')) {
    define('ENTITIES_PATH', ROOT_PATH . '/app/Entities');
}
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use meowprd\FelinePHP\Console\Colors;
use meowprd\FelinePHP\Console\CommandInterface;
use meowprd\FelinePHP\Exceptions\ConsoleException;

final class MakeEntityCommand implements CommandInterface
{
    /** @var string Command name */
    private string $command = 'make:entity';

    /** @var string Command description */
    private string $description = 'Create new entity' . Colors::GRAY . ' (--name=User)';

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
        $this->createEntityFile($params['name']);
        echo(Colors::LIGHT_GREEN . 'Entity created' . Colors::RESET . PHP_EOL);
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

    private function createEntityFile(string $entityName): void {
        $path = ENTITIES_PATH . '/' . $entityName . '.php';
        if(!file_exists(ENTITY_STUB_FILE)) throw new ConsoleException('Entity stub file not found: ' . ENTITY_STUB_FILE);
        if(file_exists($path)) throw new ConsoleException('Entity file already exists');

        $stub = file_get_contents(ENTITY_STUB_FILE);
        if($stub === false) throw new ConsoleException('Unable to read entity file: ' . ENTITY_STUB_FILE);
        if(!is_dir(ENTITIES_PATH)) mkdir(ENTITIES_PATH, 0755, true);

        $content = str_replace(
            ['{{ class }}'],
            [$entityName],
            $stub
        );
        if(file_put_contents($path, $content) === false) {
            throw new ConsoleException('Unable to write entity file: ' . $path);
        }
    }
}