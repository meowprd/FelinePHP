<?php

namespace meowprd\FelinePHP\Container;

use meowprd\FelinePHP\Exceptions\ContainerException;
use Psr\Container\ContainerInterface;

/**
 * Simple service container implementing PSR-11 ContainerInterface.
 *
 * This container stores service definitions as class names or objects
 * and can instantiate services on demand, resolving dependencies automatically.
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
     * Instantiates the service resolving constructor dependencies recursively.
     * If the service is not registered but class exists, it registers and resolves it automatically.
     *
     * @param string $id Service identifier.
     * @return mixed The resolved service instance.
     * @throws ContainerException If the service cannot be resolved.
     * @throws \ReflectionException If reflection fails.
     */
    public function get(string $id): mixed {
        if (!isset($this->services[$id])) {
            if (!class_exists($id)) {
                throw new ContainerException("Service '$id' could not be resolved");
            }
            $this->add($id);
        }

        $instance = $this->resolve($this->services[$id]);
        return $instance;
    }

    /**
     * Resolves a class or object by instantiating it with resolved constructor dependencies.
     *
     * @param string|object $class Class name or object instance.
     * @return mixed Instantiated service object.
     * @throws \ReflectionException If reflection fails.
     */
    private function resolve(string|object $class): mixed {
        if (is_object($class)) {
            return $class;
        }

        $reflection = new \ReflectionClass($class);
        $constructor = $reflection->getConstructor();

        if (is_null($constructor)) {
            return $reflection->newInstance();
        }

        $constructorParams = $constructor->getParameters();
        $classDependencies = $this->resolveReflectionDependencies($constructorParams);

        return $reflection->newInstanceArgs($classDependencies);
    }

    /**
     * Resolves dependencies for constructor parameters.
     *
     * @param \ReflectionParameter[] $constructorParams Array of reflection parameters.
     * @return array Array of resolved dependencies.
     * @throws ContainerException If a dependency cannot be resolved.
     * @throws \ReflectionException If reflection fails.
     */
    private function resolveReflectionDependencies(array $constructorParams): array {
        $dependencies = [];
        foreach ($constructorParams as $param) {
            $serviceType = $param->getType();

            if ($serviceType === null) {
                throw new ContainerException("Unable to resolve untyped parameter \${$param->getName()}");
            }

            // Support only class types
            if ($serviceType->isBuiltin()) {
                throw new ContainerException("Unable to resolve builtin parameter \${$param->getName()}");
            }

            $dependency = $this->get($serviceType->getName());
            $dependencies[] = $dependency;
        }
        return $dependencies;
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
