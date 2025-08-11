<?php

namespace meowprd\FelinePHP\Container;

use meowprd\FelinePHP\Exceptions\ContainerException;
use Psr\Container\ContainerInterface;

/**
 * Simple service container implementing PSR-11 ContainerInterface.
 *
 * This container stores service definitions as class names or objects
 * and can instantiate services on demand.
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
     * If $definition is null, tries to treat $id as a class name.
     * Throws ContainerException if class does not exist.
     *
     * @param string $id Service identifier.
     * @param string|object|null $definition Class name or object instance for the service.
     *                                       If null, $id is treated as class name.
     * @return void
     * @throws ContainerException If service definition is null and class $id doesn't exist.
     */
    public function add(string $id, string|object $definition = null): void {
        if (is_null($definition)) {
            if (!class_exists($id)) {
                throw new ContainerException("Service '$id' not found");
            }
            $definition = $id;
        }
        $this->services[$id] = $definition;
    }

    /**
     * Retrieves the service by its identifier.
     *
     * Instantiates a new instance of the service if definition is a class name.
     * If the definition is an object, it returns the object.
     *
     * @param string $id Service identifier.
     * @return mixed The resolved service instance.
     * @throws \Exception If the service is not found or cannot be instantiated.
     */
    public function get(string $id): mixed {
        if (!isset($this->services[$id])) {
            throw new ContainerException("Service '$id' not found");
        }

        $definition = $this->services[$id];

        if (is_object($definition)) {
            return $definition;
        }

        return new $definition();
    }

    /**
     * Checks if the container has a service with the given identifier.
     *
     * @param string $id Service identifier.
     * @return bool True if service exists, false otherwise.
     */
    public function has(string $id): bool {
        return isset($this->services[$id]);
    }
}
