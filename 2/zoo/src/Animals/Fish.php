<?php
namespace Zoo\Animals;

class Fish extends BaseAnimal
{
    public const CAPACITY = 10;
    public function __construct()
    {
        parent::__construct(kingdom: AnimalType::FISH, paws: 0, tails: 1, wings: 0);
    }
}
