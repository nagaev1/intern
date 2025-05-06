<?php
namespace Zoo\Managers;

use Zoo\Animals\AnimalType;

class CageManager
{
    /**
     * @param Cage[] $cages
     */
    protected $cages = [];

    public function createCage(AnimalType $kingdom): Cage
    {
        $cage = new Cage($kingdom);
        array_push($this->cages, $cage);
        return $cage;
    }

    public function getFreeCage(AnimalType $kingdom): ?Cage
    {
        foreach ($this->cages as $cage) {
            if ($cage->getKingdom() == $kingdom && !$cage->isFull()) {
                return $cage;
            }
        }
        return null;
    }

    public function getCages(): array
    {
        return $this->cages;
    }
}