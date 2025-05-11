<?php
namespace Zoo\Animals;


class Bird extends BaseAnimal
{
    public const CAPACITY = 4;
    public function __construct($tails)
    {
        parent::__construct(kingdom: AnimalType::BIRD, paws: 2, tails: $tails, wings: 2);
    }
}