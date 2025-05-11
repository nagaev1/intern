<?php

namespace Zoo\Animals;

enum AnimalType: string
{
    case BEAST = Beast::class;
    case FISH = Fish::class;
    case BIRD = Bird::class;
}
