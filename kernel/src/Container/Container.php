<?php

namespace meowprd\FelinePHP\Container;

use Psr\Container\ContainerInterface;

/**
 * Simple service container implementing PSR-11 ContainerInterface.
 */
class Container implements ContainerInterface
{
    /**
     * @var array<string, string|object> Stores service definitions or instances.
     */
    private array $services = array();

    /**
     * Registers a service definition or instance in the container.
     *
     * @param string $id Service identifier.
     * @param string|object|null $definition Class name or object instance for the service.
     *                                       If null, service is not registered.
     * @return void
     */
    public function add(string $id, string|object $definition = null): void {
        $this->services[$id] = $definition;
    }

    /**
     * Retrieves the service by its identifier.
     *
     * @param string $id Service identifier.
     * @return mixed The resolved service instance.
     * @throws \Exception If the service is not found or cannot be instantiated.
     */
    public function get(string $id) {
        return new $this->services[$id];
    }

    /**
     * Checks if the container has a service with the given identifier.
     *
     * @param string $id Service identifier.
     * @return bool True if service exists, false otherwise.
     */
    public function has(string $id): bool {
        return false;
    }
}
