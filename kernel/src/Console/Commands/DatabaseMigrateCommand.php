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
 * Database migration command handler.
 *
 * This command applies pending database migrations.
 * @final
 */
final class DatabaseMigrateCommand implements CommandInterface
{
    /** @var string Command name */
    private string $command = 'db:migrate';

    /** @var string Command description */
    private string $description = 'Run the database migrations';

    /** @var string Migrations table name */
    private const MIGRATIONS_TABLE = 'migrations';

    /**
     * @param Connection $connection Database connection
     */
    public function __construct(private readonly Connection $connection) {}

    /**
     * Execute the migration command.
     *
     * @param array $params Command parameters
     * @return int Exit code (0 on success)
     * @throws Exception
     * @throws \Throwable
     */
    public function execute(array $params = []): int
    {
        echo(Colors::LIGHT_CYAN . 'Running ' . $this->command . Colors::RESET . PHP_EOL);
        $this->createMigrationsTableIfNotExists();

        $appliedMigrations = $this->getMigrationsList();
        $migrationFiles = $this->getMigrationFiles();
        $newMigrations = array_values(array_diff($migrationFiles, $appliedMigrations));

        if (empty($newMigrations)) {
            echo(Colors::LIGHT_GREEN . "No new migrations to apply." . Colors::RESET . PHP_EOL);
            return 0;
        }

        $schemaManager = $this->connection->createSchemaManager();
        $platform = $this->connection->getDatabasePlatform();
        $comparator = $schemaManager->createComparator();

        foreach ($newMigrations as $migration) {
            echo(Colors::LIGHT_YELLOW . "Preparing $migration..." . Colors::RESET . PHP_EOL);
            $migrationInstance = require(MIGRATIONS_PATH . "/$migration");
            $fromSchema = $schemaManager->introspectSchema();
            $toSchema = clone $fromSchema;
            $migrationInstance->up($toSchema);
            $schemaDiff = $comparator->compareSchemas($fromSchema, $toSchema);
            $sqlArray = $platform->getAlterSchemaSQL($schemaDiff);
            echo(Colors::LIGHT_CYAN . "Prepared $migration" . Colors::RESET . PHP_EOL);

            foreach ($sqlArray as $sql) {
                echo(Colors::LIGHT_GRAY . "Executing: " . $sql . Colors::RESET . PHP_EOL);
                try {
                    $this->connection->executeStatement($sql);
                    $this->addMigrationToTable($migration);
                } catch (\Throwable $e) {
                    throw $e;
                }
            }
            echo(Colors::LIGHT_GREEN . "Done!" . Colors::RESET . PHP_EOL);
        }
        return 0;
    }

    /**
     * Creates migrations table if it doesn't exist.
     *
     * @throws TypesException
     * @throws Exception
     */
    private function createMigrationsTableIfNotExists(): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        $currentSchema = $schemaManager->introspectSchema();

        if ($currentSchema->hasTable(self::MIGRATIONS_TABLE)) {
            return;
        }

        echo(Colors::LIGHT_CYAN . 'Creating migrations table...' . Colors::RESET . PHP_EOL);

        $schema = new Schema();
        $table = $schema->createTable(self::MIGRATIONS_TABLE);
        $table->addColumn('id', Types::INTEGER, ['autoincrement' => true, 'unsigned' => true]);
        $table->setPrimaryKey(['id']);
        $table->addColumn('migration', Types::STRING, ['length' => 255]);
        $table->addColumn('created_at', Types::DATETIME_IMMUTABLE, ['default' => 'CURRENT_TIMESTAMP']);

        $platform = $this->connection->getDatabasePlatform();
        $sqlArray = $schema->toSql($platform);

        foreach ($sqlArray as $sql) {
            $this->connection->executeStatement($sql);
        }

        echo(Colors::LIGHT_GREEN . 'Migrations table created!' . Colors::RESET . PHP_EOL);
    }

    /**
     * Gets list of applied migrations.
     *
     * @return array List of migration filenames
     * @throws Exception
     */
    private function getMigrationsList(): array
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        return $queryBuilder
            ->select('migration')
            ->from(self::MIGRATIONS_TABLE)
            ->executeQuery()
            ->fetchFirstColumn();
    }

    /**
     * Gets migration files from migrations directory.
     *
     * @return array List of migration files
     */
    private function getMigrationFiles(): array
    {
        $files = scandir(MIGRATIONS_PATH);
        return array_values(array_filter($files, function(string $name): bool {
            return $name[0] !== '.';
        }));
    }

    /**
     * Adds migration record to migrations table.
     *
     * @param string $migration Migration filename
     * @throws Exception
     */
    private function addMigrationToTable(string $migration): void
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->insert(self::MIGRATIONS_TABLE)
            ->values(['migration' => ':migration'])
            ->setParameter('migration', $migration)
            ->executeQuery();
    }
}