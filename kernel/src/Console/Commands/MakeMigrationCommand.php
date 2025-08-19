<?php

namespace meowprd\FelinePHP\Console\Commands;

use meowprd\FelinePHP\Console\Colors;
use meowprd\FelinePHP\Console\CommandInterface;
use meowprd\FelinePHP\Exceptions\ConsoleException;

// Define constants if not already defined
if (!defined('MIGRATION_STUB_FILE')) {
    define('MIGRATION_STUB_FILE', dirname(__FILE__) . '/stubs/migration.stub.php');
}

if (!defined('MIGRATIONS_PATH')) {
    define('MIGRATIONS_PATH', ROOT_PATH . '/database/migrations');
}

/**
 * Command to create new database migrations.
 *
 * This command generates new migration files using a stub template.
 * @final
 */
final class MakeMigrationCommand implements CommandInterface
{
    /** @var string Command name */
    private string $command = 'make:migration';

    /** @var string Command description with colored hint */
    private string $description = 'Create new database migration' . Colors::GRAY . ' (--name=create_users_table)';

    /**
     * Execute the migration creation command.
     *
     * @param array $params Command parameters (requires 'name' parameter)
     * @return int Exit code (0 on success)
     * @throws ConsoleException If required parameters are missing or file operations fail
     */
    public function execute(array $params = []): int
    {
        echo Colors::LIGHT_CYAN . 'Running ' . $this->command . Colors::RESET . PHP_EOL;

        $this->validateParameters($params);
        $fileName = $this->generateFileName($params['name']);
        $this->createMigrationFile($fileName);

        echo Colors::LIGHT_GREEN . "Migration created: $fileName" . Colors::RESET . PHP_EOL;
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

    /**
     * Generate migration file name with timestamp.
     *
     * @param string $migrationName Migration name (e.g. "create_users_table")
     * @return string Formatted filename (e.g. "2023_10_15_123456_create_users_table.php")
     */
    private function generateFileName(string $migrationName): string
    {
        $timestamp = date('Y_m_d_His');
        return "{$timestamp}_{$migrationName}.php";
    }

    /**
     * Create migration file from stub template.
     *
     * @param string $fileName Target filename
     * @throws ConsoleException If stub file is missing or file creation fails
     */
    private function createMigrationFile(string $fileName): void
    {
        $path = MIGRATIONS_PATH . '/' . $fileName;

        if (!file_exists(MIGRATION_STUB_FILE)) {
            throw new ConsoleException('Migration stub file not found: ' . MIGRATION_STUB_FILE);
        }

        $stub = file_get_contents(MIGRATION_STUB_FILE);
        if ($stub === false) {
            throw new ConsoleException('Could not read stub file: ' . MIGRATION_STUB_FILE);
        }

        if(!is_dir(MIGRATIONS_PATH)) {
            mkdir(MIGRATIONS_PATH, 0755, true);
        }

        if(file_put_contents($path, $stub) === false) {
            throw new ConsoleException('Could not write migration file: ' . $path);
        }
    }
}