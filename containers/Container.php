<?php

namespace Containers;

use ReflectionException;

class Container implements ContainerInterface
{
    private array $objects = [];

    /**
     * Check if the object with the given identifier exists in the container
     * or if there is a class with the given identifier.
     */
    public function has(string $id): bool
    {
        return isset($this->objects[$id]) || class_exists($id);
    }

    /**
     * @throws ReflectionException
     */
    public function get(string $id): mixed
    {
        // If the object exists in the container, return it; otherwise, prepare and return it.
        return isset($this->objects[$id]) ? $this->objects[$id]() : $this->prepareObject($id);
    }

    /**
     * @throws ReflectionException
     */
    private function prepareObject(string $class): object
    {
        // Create a ReflectionClass instance for the specified class.
        $classReflector = new \ReflectionClass($class);

        // Get the constructor reflector of the class and check if it exists.
        // If there is no constructor, return an instance of the class directly.
        $constructReflector = $classReflector->getConstructor();
        if (empty($constructReflector)) {
            return new $class;
        }

        // Get the parameter reflectors of the constructor.
        // If there are no constructor parameters, return an instance of the class directly.
        $constructArguments = $constructReflector->getParameters();
        if (empty($constructArguments)) {
            return new $class;
        }

        // Iterate through all constructor parameters and collect their values.
        $args = [];
        foreach ($constructArguments as $argument) {
            // Get the type of the argument.
            $argumentType = $argument->getType()->getName();
            // Retrieve the argument itself from the container based on its type.
            $args[$argument->getName()] = $this->get($argumentType);
        }

        // Return an instance of the class with all its dependencies resolved.
        return new $class(...$args);
    }
}