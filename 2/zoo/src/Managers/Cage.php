<?php

namespace Zoo\Managers;

use Zoo\Animals\{BaseAnimal, AnimalType};

class Cage
{
    /**
     * @param Animals[] $animals
     */
    protected $animals = [];
    public readonly int $capacity;

    public function __construct(protected AnimalType $kingdom)
    {
        $ref = new \ReflectionClass($kingdom->value);
        $this->capacity = $ref->getConstant('CAPACITY');
    }

    public function putAnimal(BaseAnimal $animal): void
    {
        if ($this->kingdom != $animal->getKingdom()) {
            echo "wrong kingdom \n";
            return;
        }
        array_push($this->animals, $animal);
    }
    public function getAnimal(int $index = 0): ?BaseAnimal
    {
        if ($this->isEmpty()) {
            return null;
        }
        return $this->animals[$index];
    }

    public function removeAnimal(int $index = 0): ?BaseAnimal
    {
        if ($this->isEmpty()) {
            return null;
        }
        $animal = $this->animals[$index];
        array_splice($this->animals, $index, 1);
        return $animal;
    }

    public function getKingdom(): AnimalType
    {
        return $this->kingdom;
    }

    public function isEmpty(): bool
    {
        return empty($this->animals);
    }

    public function isFull(): bool
    {
        return count($this->animals) === $this->capacity;
    }
}
