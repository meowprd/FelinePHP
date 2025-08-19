<?php

namespace meowprd\FelinePHP\Console\Commands;

use Doctrine\DBAL\Connection;
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
        return 0;
    }
}