<?php

namespace meowprd\FelinePHP\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use meowprd\FelinePHP\Entity\AbstractEntity;

/**
 * Abstract base repository providing common database operations for entities.
 *
 * This class implements CRUD operations and common query methods using Doctrine DBAL.
 * Concrete repositories should extend this class and implement abstract methods.
 */
abstract class AbstractRepository
{
    /**
     * @param Connection $connection Doctrine DBAL connection instance
     */
    public function __construct(protected Connection $connection) {}

    /**
     * Get the database table name for this repository.
     *
     * @return string Table name
     */
    abstract protected function getTableName(): string;

    /**
     * Create an entity instance from database data.
     *
     * @param array<string, mixed> $data Database row data
     * @return object Entity instance
     */
    abstract protected function createEntity(array $data): object;

    /**
     * Find an entity by its primary key.
     *
     * @param int $id Entity ID
     * @return object|null Entity instance or null if not found
     */
    public function find(int $id): ?object
    {
        $data = $this->connection->fetchAssociative(
            "SELECT * FROM {$this->getTableName()} WHERE id = ?",
            [$id]
        );

        return $data ? $this->createEntity($data) : null;
    }

    /**
     * Find all entities.
     *
     * @return array<object> Array of entity instances
     */
    public function findAll(): array
    {
        $data = $this->connection->fetchAllAssociative(
            "SELECT * FROM {$this->getTableName()}"
        );

        return array_map([$this, 'createEntity'], $data);
    }

    /**
     * Find entities by criteria with optional ordering and pagination.
     *
     * @param array<string, mixed> $criteria Search criteria (field => value)
     * @param array<string, string>|null $orderBy Ordering criteria (field => 'ASC'|'DESC')
     * @param int|null $limit Maximum number of results
     * @param int|null $offset Number of results to skip
     * @return array<object> Array of matching entity instances
     */
    public function findBy(array $criteria, ?array $orderBy = null, ?int $limit = null, ?int $offset = null): array
    {
        $queryBuilder = $this->connection->createQueryBuilder()
            ->select("*")
            ->from($this->getTableName());

        // Add WHERE conditions
        foreach ($criteria as $field => $value) {
            $queryBuilder->andWhere("{$field} = :{$field}")
                ->setParameter($field, $value);
        }

        // Add ORDER BY clauses
        if ($orderBy !== null) {
            foreach ($orderBy as $field => $direction) {
                $queryBuilder->addOrderBy($field, $direction);
            }
        }

        // Add LIMIT and OFFSET
        if ($limit !== null) {
            $queryBuilder->setMaxResults($limit);
        }

        if ($offset !== null) {
            $queryBuilder->setFirstResult($offset);
        }

        $data = $queryBuilder->fetchAllAssociative();

        return array_map([$this, 'createEntity'], $data);
    }

    /**
     * Find a single entity by criteria.
     *
     * @param array<string, mixed> $criteria Search criteria (field => value)
     * @param array<string, string>|null $orderBy Ordering criteria for tie-breaking
     * @return object|null Entity instance or null if not found
     */
    public function findOneBy(array $criteria, ?array $orderBy = null): ?object
    {
        $result = $this->findBy($criteria, $orderBy, 1);

        return $result[0] ?? null;
    }

    /**
     * Create a new QueryBuilder instance for custom queries.
     *
     * @return QueryBuilder Doctrine QueryBuilder instance
     */
    protected function createQueryBuilder(): QueryBuilder
    {
        return $this->connection->createQueryBuilder();
    }

    /**
     * Save an entity to the database.
     *
     * @param AbstractEntity $entity Entity to save
     * @return void
     */
    abstract public function save(AbstractEntity $entity): void;

    /**
     * Delete an entity from the database.
     *
     * @param AbstractEntity $entity Entity to delete
     * @return void
     */
    abstract public function delete(AbstractEntity $entity): void;
}