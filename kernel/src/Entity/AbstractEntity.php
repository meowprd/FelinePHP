<?php

namespace meowprd\FelinePHP\Entity;

use DateTimeImmutable;

/**
 * Abstract base entity providing common properties and methods for all entities.
 *
 * This class handles automatic timestamp management and provides basic functionality
 * that all entities should inherit.
 */
abstract class AbstractEntity
{
    /**
     * @var int|null Unique identifier
     */
    protected ?int $id = null;

    /**
     * @var DateTimeImmutable Creation timestamp
     */
    protected DateTimeImmutable $createdAt;

    /**
     * @var DateTimeImmutable Last update timestamp
     */
    protected DateTimeImmutable $updatedAt;

    /**
     * Constructor initializes timestamps.
     */
    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }

    /**
     * Get the entity ID.
     *
     * @return int|null Entity ID or null if not persisted
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the entity ID.
     *
     * @param int|null $id Entity ID or null to unset
     * @return void
     */
    public function setId(?int $id = null): void
    {
        $this->id = $id;
    }

    /**
     * Get the creation timestamp.
     *
     * @return DateTimeImmutable Creation timestamp
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * Get the last update timestamp.
     *
     * @return DateTimeImmutable Last update timestamp
     */
    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * Update the last modified timestamp to current time.
     *
     * @return void
     */
    public function touch(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }

    /**
     * Convert entity to array for persistence or serialization.
     *
     * @return array<string, mixed> Array representation of the entity
     */
    abstract public function toArray(): array;
}