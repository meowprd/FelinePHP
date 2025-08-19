<?php

/**
 * Database migration stub.
 *
 * This anonymous class provides a template for creating database migrations.
 * The `up()` method applies the migration changes,
 * while the `down()` method reverts them (for rollback purposes).
 */
return new class {
    /**
     * Apply the migration changes.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema Database schema
     * @return void
     */
    public function up(\Doctrine\DBAL\Schema\Schema $schema): void
    {
        // TODO: Implement migration changes
        echo get_class($this) . ' up' . PHP_EOL;
    }

    /**
     * Reverse the migration changes.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema Database schema
     * @return void
     */
    public function down(\Doctrine\DBAL\Schema\Schema $schema): void
    {
        // TODO: Implement rollback changes
        echo get_class($this) . ' down' . PHP_EOL;
    }
};