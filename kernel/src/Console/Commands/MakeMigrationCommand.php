<?php
namespace meowprd\FelinePHP\Console\Commands;

define('STUB_FILE', dirname(__FILE__) . '/stubs/migration.stub.php');
define('MIGRATIONS_PATH', ROOT_PATH . '/database/migrations');
use meowprd\FelinePHP\Console\Colors;
use meowprd\FelinePHP\Console\CommandInterface;
use meowprd\FelinePHP\Exceptions\ContainerException;

class MakeMigrationCommand implements CommandInterface
{
    private string $command = 'make:migration';
    private string $description = 'Create new database migration' . Colors::GRAY . ' (--name create_users_table)';

    /**
     * @throws ContainerException
     */
    public function execute(array $params = []): int
    {
        echo(Colors::LIGHT_CYAN . 'Running ' . $this->command . Colors::RESET . PHP_EOL);
        if(!isset($params['name'])) { throw new ContainerException('Missing required parameter "name"'); }
        $timestamp = date('Y_m_d_His');
        $fileName = "{$timestamp}_{$params['name']}.php";
        $path = MIGRATIONS_PATH . "/$fileName";
        $stub = file_get_contents(STUB_FILE);
        file_put_contents($path, $stub);
        echo(Colors::LIGHT_GREEN . "Migration created: $fileName" . Colors::RESET . PHP_EOL);
        return 0;
    }
}