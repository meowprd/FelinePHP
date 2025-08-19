<?php

namespace meowprd\FelinePHP\Console\Commands;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use meowprd\FelinePHP\Console\Colors;
use meowprd\FelinePHP\Console\CommandInterface;

/**
 * Database fresh command handler.
 *
 * This command drops all database tables and re-runs all migrations,
 * effectively resetting the database to a fresh state.
 * @final
 */
final class DatabaseFreshCommand implements CommandInterface
{
    /** @var string Command name */
    private string $command = 'db:fresh';

    /** @var string Command description */
    private string $description = 'Drop all tables and re-run migrations';

    /** @var string Migrations table name */
    private const MIGRATIONS_TABLE = 'migrations';

    /**
     * @param Connection $connection Database connection
     * @param DatabaseMigrateCommand $migrateCommand Migration command instance
     */
    public function __construct(
        private readonly Connection $connection,
        private readonly DatabaseMigrateCommand $migrateCommand
    ) {}

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

        if (!$this->confirmProceed()) {
            echo(Colors::LIGHT_YELLOW . "Operation cancelled." . Colors::RESET . PHP_EOL);
            return 0;
        }

        $this->connection->beginTransaction();
        try {
            $this->dropAllTables();
            $this->migrateCommand->execute($params);

            echo(Colors::LIGHT_GREEN . "Database refreshed successfully!" . Colors::RESET . PHP_EOL);
            return 0;
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    /**
     * Confirm operation with user.
     *
     * @return bool True if user confirmed
     */
    private function confirmProceed(): bool
    {
        echo(Colors::LIGHT_RED . "WARNING: This will drop ALL database tables! Continue? (yes/no) " . Colors::RESET);
        $handle = fopen("php://stdin", "r");
        $input = strtolower(trim(fgets($handle)));
        fclose($handle);

        return $input === 'yes' || $input === 'y';
    }

    /**
     * Drop all database tables.
     */
    private function dropAllTables(): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        $tables = $schemaManager->listTables();

        if (empty($tables)) {
            echo(Colors::LIGHT_YELLOW . "No tables to drop." . Colors::RESET . PHP_EOL);
            return;
        }

        $platform = $this->connection->getDatabasePlatform();

        foreach ($tables as $table) {
            $tableName = $table->getName();
            echo(Colors::LIGHT_YELLOW . "Dropping table: " . $tableName . Colors::RESET . PHP_EOL);
            $this->connection->executeStatement($platform->getDropTableSQL($tableName));
        }
    }
}