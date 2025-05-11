<?php

namespace Zoo\Animals;

use Zoo\Animals\AnimalType;

abstract class BaseAnimal
{
    public const CAPACITY = 1;
    public function __construct(
        public AnimalType $kingdom,
        public int $paws,
        public int $tails,
        public int $wings
    ) {}

    public function getKingdom(): AnimalType
    {
        return $this->kingdom;
    }
}
