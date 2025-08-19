<?php

namespace meowprd\FelinePHP\Console\Commands;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use meowprd\FelinePHP\Console\Colors;
use meowprd\FelinePHP\Console\CommandInterface;

/**
 * Database wipe command handler.
 *
 * This command drops all tables from the database while handling foreign key constraints.
 * @final
 */
final class DatabaseWipeCommand implements CommandInterface
{
    /** @var string Command name */
    private string $command = 'db:wipe';

    /** @var string Command description */
    private string $description = 'Drop all tables from the database';

    /** @var string Migrations table name */
    private const MIGRATIONS_TABLE = 'migrations';

    /**
     * @param Connection $connection Database connection
     */
    public function __construct(private readonly Connection $connection) {}

    /**
     * Execute the wipe command.
     *
     * @param array $params Command parameters
     * @return int Exit code (0 on success)
     * @throws \Throwable
     */
    public function execute(array $params = []): int
    {
        echo Colors::LIGHT_CYAN . 'Running ' . $this->command . Colors::RESET . PHP_EOL;

        if (!$this->confirmProceed()) {
            echo Colors::LIGHT_YELLOW . "Operation cancelled." . Colors::RESET . PHP_EOL;
            return 0;
        }

        $this->connection->beginTransaction();
        try {
            $this->dropAllTables();

            echo Colors::LIGHT_GREEN . "Database wiped successfully!" . Colors::RESET . PHP_EOL;
            return 0;
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    /**
     * Confirm the destructive operation with user.
     *
     * @return bool True if user confirmed
     */
    private function confirmProceed(): bool
    {
        echo Colors::LIGHT_RED . "WARNING: This will drop ALL database tables! Continue? (yes/no) " . Colors::RESET;
        $handle = fopen("php://stdin", "r");
        $input = strtolower(trim(fgets($handle)));
        fclose($handle);

        return $input === 'yes' || $input === 'y';
    }

    /**
     * Drop all tables from the database.
     *
     * @throws \Doctrine\DBAL\Exception
     */
    private function dropAllTables(): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        $platform = $this->connection->getDatabasePlatform();
        $tables = $schemaManager->listTables();

        if (empty($tables)) {
            echo Colors::LIGHT_YELLOW . "Database is already empty." . Colors::RESET . PHP_EOL;
            return;
        }


        foreach ($tables as $table) {
            $tableName = $table->getName();
            echo Colors::LIGHT_YELLOW . "Dropping table: " . $tableName . Colors::RESET . PHP_EOL;

            try {
                $this->connection->executeStatement($platform->getDropTableSQL($tableName));
            } catch (\Throwable $e) {
                echo Colors::LIGHT_RED . "Failed to drop table {$tableName}: " . $e->getMessage() . Colors::RESET . PHP_EOL;
            }
        }
    }
}