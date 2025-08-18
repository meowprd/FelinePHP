<?php

namespace meowprd\FelinePHP\Database;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

/**
 * Factory for creating Doctrine DBAL Connection instances.
 *
 * This class encapsulates the database configuration and
 * provides a method to create a ready-to-use DBAL connection.
 */
class ConnectionFactory
{
    /**
     * @param array<string, mixed> $databaseConfig
     */
    public function __construct(
        private readonly array $databaseConfig
    ) {}

    /**
     * Create a new Doctrine DBAL Connection.
     *
     * @return Connection A configured DBAL connection instance.
     */
    public function create(): Connection
    {
        return DriverManager::getConnection($this->databaseConfig);
    }
}
