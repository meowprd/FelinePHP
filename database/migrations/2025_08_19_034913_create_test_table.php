<?php

return new class {
    public function up(\Doctrine\DBAL\Schema\Schema $schema): void {
        $table = $schema->createTable('test');
        $table->addColumn('id', \Doctrine\DBAL\Types\Types::INTEGER, ['autoincrement' => true, 'unsigned' => true]);
        $table->addColumn('user', \Doctrine\DBAL\Types\Types::STRING, ['length' => 50]);
        $table->addColumn('created_at', \Doctrine\DBAL\Types\Types::DATETIME_IMMUTABLE, array('default' => 'CURRENT_TIMESTAMP'));
        $table->addPrimaryKeyConstraint(\Doctrine\DBAL\Schema\PrimaryKeyConstraint::editor()->setUnquotedColumnNames('id')->create());
    }

    public function down(\Doctrine\DBAL\Schema\Schema $schema): void {
        if($schema->hasTable('test')){
            $schema->dropTable('test');
        }
    }
};