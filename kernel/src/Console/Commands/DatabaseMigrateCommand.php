<?php

namespace meowprd\FelinePHP\Console\Commands;
if(!defined("MIGRATIONS_PATH")) {
    define('MIGRATIONS_PATH', ROOT_PATH . '/database/migrations');
}

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Exception\TypesException;
use Doctrine\DBAL\Types\Types;
use meowprd\FelinePHP\Console\Colors;
use meowprd\FelinePHP\Console\CommandInterface;

class DatabaseMigrateCommand implements CommandInterface
{
    private string $command = 'db:migrate';
    private string $description = 'Run the database migrations';
    private const MIGRATIONS_TABLE = 'migrations';

    public function __construct(private readonly Connection $connection) {}

    public function execute(array $params = []): int
    {
        echo(Colors::LIGHT_CYAN . 'Running ' . $this->command . Colors::RESET . PHP_EOL);
        $this->createMigrationsTableIfNotExists();

        $appliedMigrations = $this->getMigrationsList();
        $migrationFiles = $this->getMigrationFiles();
        $newMigrations = array_values(array_diff($migrationFiles, $appliedMigrations));

        foreach($newMigrations as $migration) {
            $schema = new Schema();
            echo(Colors::LIGHT_YELLOW . "Preparing $migration..." . Colors::RESET . PHP_EOL);
            $migrationInstance = require(MIGRATIONS_PATH . "/$migration");
            $migrationInstance->up($schema);
            echo(Colors::LIGHT_CYAN . "Prepared $migration" . Colors::RESET . PHP_EOL);
            $sqlArray = $schema->toSql($this->connection->getDatabasePlatform());
            foreach($sqlArray as $sql) {
                echo(Colors::LIGHT_GRAY . $sql . Colors::RESET . PHP_EOL);
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
     * @throws TypesException
     * @throws Exception
     */
    private function createMigrationsTableIfNotExists(): void {
        $manager = $this->connection->createSchemaManager();
        if($manager->tableExists(self::MIGRATIONS_TABLE)) { return; }

        echo(Colors::LIGHT_CYAN . 'Creating migrations table...' . Colors::RESET . PHP_EOL);
        $schema = new Schema();
        $table = $schema->createTable(self::MIGRATIONS_TABLE);
        $table->addColumn('id', Types::INTEGER, ['autoincrement' => true, 'unsigned' => true]);
        $table->setPrimaryKey(array('id'));
        $table->addColumn('migration', Types::STRING, ['length' => 255]);
        $table->addColumn('created_at', Types::DATETIME_IMMUTABLE, array('default' => 'CURRENT_TIMESTAMP'));
        $sqlArray = $schema->toSql($this->connection->getDatabasePlatform());
        $this->connection->executeQuery($sqlArray[0]);
        echo(Colors::LIGHT_GREEN . 'Done!' . PHP_EOL);
    }

    private function getMigrationsList(): array {
        $queryBuilder = $this->connection->createQueryBuilder();
        return $queryBuilder
            ->select('migration')
            ->from(self::MIGRATIONS_TABLE)
            ->executeQuery()
            ->fetchFirstColumn();
    }

    private function getMigrationFiles(): array {
        $files = scandir(MIGRATIONS_PATH);
        return array_values(array_filter($files, function(string $name): bool {
            return $name[0] !== '.';
        }));
    }

    private function addMigrationToTable(string $migration): void {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->insert(self::MIGRATIONS_TABLE)
            ->values(array('migration' => ':migration'))
            ->setParameter('migration', $migration)
            ->executeQuery();
    }

    private function addMigrationsToTable(array $migrations): void {
        foreach($migrations as $migration) { $this->addMigrationToTable($migration); }
    }
}