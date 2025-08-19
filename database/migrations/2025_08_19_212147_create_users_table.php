<?php

use Doctrine\DBAL\Schema\PrimaryKeyConstraint;
use Doctrine\DBAL\Types\Types;

return new class {
    /**
     * Apply the migration changes.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema Database schema
     * @return void
     */
    public function up(\Doctrine\DBAL\Schema\Schema $schema): void
    {
        $table = $schema->createTable('users');
        $table->addColumn('id', Types::INTEGER, ['autoincrement' => true, 'unsigned' => true]);
        $table->addColumn('login', Types::STRING, ['length' => 255]);
        $table->addColumn('password', Types::STRING, ['length' => 255]);
        $table->addColumn('created_at', Types::DATETIME_IMMUTABLE, ['notnull' => true]);
        $table->addColumn('updated_at', Types::DATETIME_IMMUTABLE, ['notnull' => true]);
        $table->addPrimaryKeyConstraint(PrimaryKeyConstraint::editor()->setUnquotedColumnNames('id')->create());
    }

    /**
     * Reverse the migration changes.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema Database schema
     * @return void
     */
    public function down(\Doctrine\DBAL\Schema\Schema $schema): void
    {
        if ($schema->hasTable('users')) {
            $schema->dropTable('users');
        }
    }
};