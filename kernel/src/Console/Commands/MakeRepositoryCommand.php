<?php

namespace meowprd\FelinePHP\Console\Commands;

// Define constants if not already defined
if (!defined('REPOSITORY_STUB_FILE')) {
    define('REPOSITORY_STUB_FILE', dirname(__FILE__) . '/stubs/repository.stub.php');
}

if (!defined('REPOSITORIES_PATH')) {
    define('REPOSITORIES_PATH', ROOT_PATH . '/app/Repositories');
}
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use meowprd\FelinePHP\Console\Colors;
use meowprd\FelinePHP\Console\CommandInterface;
use meowprd\FelinePHP\Exceptions\ConsoleException;

final class MakeRepositoryCommand implements CommandInterface
{
    /** @var string Command name */
    private string $command = 'make:repository';

    /** @var string Command description */
    private string $description = 'Create new repository template' . Colors::GRAY . ' (--name=UserRepository)';

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
        $this->createRepositoryFile($params['name']);
        echo(Colors::LIGHT_GREEN . 'Repository created' . Colors::RESET . PHP_EOL);
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

    private function createRepositoryFile(string $repositoryName): void {
        $path = REPOSITORIES_PATH . '/' . $repositoryName . '.php';
        if(!file_exists(REPOSITORY_STUB_FILE)) throw new ConsoleException('Repository stub file not found: ' . REPOSITORY_STUB_FILE);
        if(file_exists($path)) throw new ConsoleException('Repository file already exists');

        $stub = file_get_contents(REPOSITORY_STUB_FILE);
        if($stub === false) throw new ConsoleException('Unable to read repository stub file: ' . REPOSITORY_STUB_FILE);
        if(!is_dir(REPOSITORIES_PATH)) mkdir(REPOSITORIES_PATH, 0755, true);

        $content = str_replace(
            ['{{ class }}'],
            [$repositoryName],
            $stub
        );
        if(file_put_contents($path, $content) === false) {
            throw new ConsoleException('Unable to write repository file: ' . $path);
        }
    }
}