<?php

return new class {
    public function up(\Doctrine\DBAL\Schema\Schema $schema): void {
        $table = $schema->getTable('test');
        if(!$table->hasColumn('email')) {
            $table->addColumn('email', \Doctrine\DBAL\Types\Types::STRING, ['length' => 255]);
        }
    }

    public function down(\Doctrine\DBAL\Schema\Schema $schema): void {
        $table = $schema->getTable('test');
        if ($table->hasColumn('email')) {
            $table->dropColumn('email');
        }
    }
};