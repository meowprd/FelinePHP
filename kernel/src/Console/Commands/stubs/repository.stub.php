<?php

namespace App\Repositories;

use meowprd\FelinePHP\Entity\AbstractEntity;
use meowprd\FelinePHP\Repository\AbstractRepository;
use Doctrine\DBAL\Connection;

class {{ class }} extends AbstractRepository
{
    public function __construct(protected Connection $connection)
    {
        parent::__construct($connection);
    }

    protected function getTableName(): string {
        // todo
        return 'TABLE_NAME';
    }

    protected function createEntity(array $data): object
    {
        // todo
    }

    public function save(AbstractEntity $entity): void {
        $data = $entity->toArray();
        if($entity->getId() === null) {
            $this->connection->insert($this->getTableName(), $data);
            $entity->setId((int)$this->connection->lastInsertId());
        } else {
            $this->connection->update($this->getTableName(), $data, ['id' => $entity->getId()]);
        }
    }

    public function delete(AbstractEntity $entity): void {
        $this->connection->delete($this->getTableName(), ['id' => $entity->getId()]);
    }
}