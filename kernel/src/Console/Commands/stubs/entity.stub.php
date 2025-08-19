<?php

namespace App\Entities;

use meowprd\FelinePHP\Entity\AbstractEntity;
use DateTimeImmutable;

class {{ class }} extends AbstractEntity {
    /**
     * @var string Example property
     */
    private string $exampleProperty;

    public function __construct(string $exampleProperty)
    {
        parent::__construct();
        $this->exampleProperty = $exampleProperty;
    }

    /**
     * Get example property.
     *
     * @return string
     */
    public function getExampleProperty(): string
    {
        return $this->exampleProperty;
    }

    /**
     * Set example property.
     *
     * @param string $exampleProperty
     * @return self
     */
    public function setExampleProperty(string $exampleProperty): self
    {
        $this->exampleProperty = $exampleProperty;
        $this->touch();
        return $this;
    }

    /**
     * Convert entity to array for persistence.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'example_property' => $this->exampleProperty,
            'created_at' => $this->getCreatedAt()->format('Y-m-d H:i:s'),
            'updated_at' => $this->getUpdatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}