<?php

return new class {
    public function up(\Doctrine\DBAL\Schema\Schema $schema): void {
        // todo
        echo get_class($this) . ' up' . PHP_EOL;
    }

    public function down(\Doctrine\DBAL\Schema\Schema $schema): void {
        // todo
        echo get_class($this) . ' down' . PHP_EOL;
    }
};