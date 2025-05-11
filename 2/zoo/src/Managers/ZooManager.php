<?php

namespace Zoo\Managers;

use Zoo\Animals\BaseAnimal;

class ZooManager
{
    public function __construct(protected $cageManager = new CageManager()) {}

    public function putAnimal(BaseAnimal $animal): Cage
    {
        $cage = $this->cageManager->getFreeCage($animal->getKingdom());
        if ($cage == null) {
            $cage = $this->cageManager->createCage($animal->getKingdom());
        }
        $cage->putAnimal($animal);
        return $cage;
    }

    public function getCages(): array
    {
        return $this->cageManager->getCages();
    }

    public function clearCages()
    {
        foreach ($this->cageManager->getCages() as $cage) {
            $cage->removeAnimal();
        }
    }

    public function findAnimal($kingdom, $paws, $tails, $wings): ?BaseAnimal
    {
        foreach ($this->getCages() as $cage) {
            $animal = $cage->getAnimal();
            if ($animal == null) {
                continue;
            }
            if ($animal->kingdom == $kingdom && $animal->paws == $paws && $animal->tails == $tails && $animal->wings == $wings) {
                return $animal;
            }
        }
        return null;
    }
}
