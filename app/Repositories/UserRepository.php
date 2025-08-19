<?php

namespace App\Repositories;

use meowprd\FelinePHP\Entity\AbstractEntity;
use meowprd\FelinePHP\Repository\AbstractRepository;
use App\Entities\User;
use Doctrine\DBAL\Connection;

class UserRepository extends AbstractRepository
{
    public function __construct(protected Connection $connection)
    {
        parent::__construct($connection);
    }

    protected function getTableName(): string { return 'users'; }

    protected function createEntity(array $data): User
    {
        $user = new User($data['login']);
        $user->setId($data['id']);
        $user->setPasswordWithoutTouch($data['password']);
        return $user;
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

    public function findByLogin(string $login): ?User {
        return $this->findOneBy(['login' => $login]) ?? array();
    }
}