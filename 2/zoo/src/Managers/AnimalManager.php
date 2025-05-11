<?php

namespace Zoo\Managers;

use Zoo\Animals\{BaseAnimal, Beast, Fish, Bird, AnimalType};

class AnimalManager
{
    public static function createRandomAnimal(): BaseAnimal
    {
        $typeArr = AnimalType::cases();
        return match ($typeArr[array_rand($typeArr)]) {
            AnimalType::BEAST => new Beast(4, 1),
            AnimalType::FISH => new Fish(),
            AnimalType::BIRD => new Bird(1),
            default => new Beast(4, 1)
        };
    }
}
