<?php

namespace meowprd\FelinePHP\Console\Commands;

if (!defined("MIGRATIONS_PATH")) {
    define('MIGRATIONS_PATH', ROOT_PATH . '/database/migrations');
}

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Exception\TypesException;
use Doctrine\DBAL\Types\Types;
use meowprd\FelinePHP\Console\Colors;
use meowprd\FelinePHP\Console\CommandInterface;

/**
 * Database rollback command handler.
 *
 * This command rolls back the most recently applied migration.
 * @final
 */
final class DatabaseRollbackCommand implements CommandInterface
{
    /** @var string Command name */
    private string $command = 'db:rollback';

    /** @var string Command description */
    private string $description = 'Rollback the last migration';

    /** @var string Migrations table name */
    private const MIGRATIONS_TABLE = 'migrations';

    /**
     * @param Connection $connection Database connection
     */
    public function __construct(private readonly Connection $connection) {}

    /**
     * Execute the rollback command.
     *
     * @param array $params Command parameters
     * @return int Exit code (0 on success)
     * @throws Exception
     */
    public function execute(array $params = []): int
    {
        echo(Colors::LIGHT_CYAN . 'Running ' . $this->command . Colors::RESET . PHP_EOL);

        $lastMigration = $this->getLastMigration();
        if (!$lastMigration) {
            echo(Colors::LIGHT_YELLOW . "No migrations to rollback." . Colors::RESET . PHP_EOL);
            return 0;
        }

        echo(Colors::LIGHT_YELLOW . "Rolling back: " . $lastMigration . Colors::RESET . PHP_EOL);

        $schemaManager = $this->connection->createSchemaManager();
        $comparator = $schemaManager->createComparator();

        $migrationInstance = require(MIGRATIONS_PATH . "/$lastMigration");
        $fromSchema = $schemaManager->introspectSchema();
        $toSchema = clone $fromSchema;

        $migrationInstance->down($toSchema);

        $schemaDiff = $comparator->compareSchemas($fromSchema, $toSchema);
        $sqlArray = $this->connection->getDatabasePlatform()->getAlterSchemaSQL($schemaDiff);

        $this->connection->beginTransaction();
        try {
            foreach ($sqlArray as $sql) {
                echo(Colors::LIGHT_GRAY . "Executing: " . $sql . Colors::RESET . PHP_EOL);
                $this->connection->executeStatement($sql);
            }

            $this->removeMigrationFromTable($lastMigration);

            echo(Colors::LIGHT_GREEN . "Successfully rolled back: " . $lastMigration . Colors::RESET . PHP_EOL);
            return 0;
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    /**
     * Gets the last applied migration.
     *
     * @return string|null Migration filename or null if none exists
     * @throws Exception
     */
    private function getLastMigration(): ?string
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        return $queryBuilder
            ->select('migration')
            ->from(self::MIGRATIONS_TABLE)
            ->orderBy('id', 'DESC')
            ->setMaxResults(1)
            ->executeQuery()
            ->fetchOne() ?: null;
    }

    /**
     * Removes migration record from migrations table.
     *
     * @param string $migration Migration filename to remove
     * @throws Exception
     */
    private function removeMigrationFromTable(string $migration): void
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->delete(self::MIGRATIONS_TABLE)
            ->where('migration = :migration')
            ->setParameter('migration', $migration)
            ->executeQuery();
    }
}