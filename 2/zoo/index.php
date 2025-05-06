<?php

use Zoo\Managers\AnimalManager;
use Zoo\Managers\ZooManager;

require_once realpath("vendor/autoload.php");


$zooManager = new ZooManager();

for ($i = 1; $i <= 10; $i++) {
    $zooManager->putAnimal(AnimalManager::createRandomAnimal());
}
$zooManager->clearCages();
for ($i = 1; $i <= 10; $i++) {
    $zooManager->putAnimal(AnimalManager::createRandomAnimal());
}
echo print_r($zooManager->getCages(), true);
// echo print_r($zooManager->findAnimal('beast', 4, 1, 0));
