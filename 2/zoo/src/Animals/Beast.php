<?php

namespace Zoo\Animals;

class Beast extends BaseAnimal
{
    public function __construct($paws, $tails)
    {
        parent::__construct(kingdom: AnimalType::BEAST, paws: $paws, tails: $tails, wings: 0);
    }
}
