<?php

abstract class Animal
{
    public string $kingdom;
    public int $paws;
    public int $tails;
    public int $wings;

    public function __construct($kingdom, $paws, $tails, $wings)
    {
        $this->kingdom = $kingdom;
        $this->paws = $paws;
        $this->tails = $tails;
        $this->wings = $wings;
    }

    public function get_kingdom(): string
    {
        return $this->kingdom;
    }

}

class Beast extends Animal
{
    public function __construct($paws, $tails)
    {
        parent::__construct(kingdom: 'beast', paws: $paws, tails: $tails, wings: 0);
    }
}

class Fish extends Animal
{
    public function __construct()
    {
        parent::__construct(kingdom: 'fish', paws: 0, tails: 1, wings: 0);
    }
}

class Bird extends Animal
{
    public function __construct($tails)
    {
        parent::__construct(kingdom: 'bird', paws: 2, tails: $tails, wings: 2);
    }
}

class Cage
{
    protected string $kingdom;
    protected ?Animal $animal;

    public function __construct(string $kingdom)
    {
        $this->kingdom = $kingdom;
    }

    public function put_animal(Animal $animal): void
    {
        if ($this->kingdom != $animal->get_kingdom()) {
            echo "wrong kingdom \n";
            return;
        }
        $this->animal = $animal;
    }
    public function get_animal(): ?Animal
    {
        return $this->animal;
    }

    public function remove_animal(): Animal
    {
        $animal = $this->animal;
        $this->animal = null;
        return $animal;
    }

    public function get_kingdom(): string
    {
        return $this->kingdom;
    }
}

class CageManager
{
    /**
     * @param Cage[] $cages
     */
    protected $cages = [];

    public function create_cage(string $kingdom): Cage
    {
        $cage = new Cage($kingdom);
        array_push($this->cages, $cage);
        return $cage;
    }

    public function get_free_cage(string $kingdom): ?Cage
    {
        foreach ($this->cages as $cage) {
            if ($cage->get_kingdom() == $kingdom && $cage->get_animal() == null) {
                return $cage;
            }
        }
        return null;
    }

    public function get_cages(): array
    {
        return $this->cages;
    }
}

class ZooWatcher
{

    protected CageManager $cageManager;

    public function __construct()
    {
        $this->cageManager = new CageManager();
    }

    public function put_animal(Animal $animal): Cage
    {
        $cage = $this->cageManager->get_free_cage($animal->get_kingdom());
        if ($cage == null) {
            $cage = $this->cageManager->create_cage($animal->get_kingdom());
        }
        $cage->put_animal($animal);
        return $cage;
    }

    public function get_cages(): array
    {
        return $this->cageManager->get_cages();
    }

    public function clear_cages()
    {
        foreach ($this->cageManager->get_cages() as $cage) {
            $cage->remove_animal();
        }

    }

    public function find_animal($kingdom, $paws, $tails, $wings): ?Animal
    {
        foreach ($this->get_cages() as $cage) {
            $animal = $cage->get_animal();
            if ($animal == null) {
                continue;
            }
            if ($animal->kingdom = $kingdom && $animal->paws == $paws && $animal->tails == $tails && $animal->wings == $wings) {
                return $animal;
            }
        }
        return null;
    }
}

class Manager
{
    public static function create_random_animal(): Animal
    {
        return match (['beast', 'fish', 'bird'][random_int(0, 2)]) {
            'beast' => new Beast(4, 1),
            'fish' => new Fish(),
            'bird' => new Bird(1),
            default => new Beast(4, 1)
        };
    }
}

$zooWatcher = new ZooWatcher();

for ($i = 1; $i <= 10; $i++) {
    $zooWatcher->put_animal(Manager::create_random_animal());
}
// $zooWatcher->clear_cages();
// for ($i = 1; $i <= 10; $i++) {
//     $zooWatcher->put_animal(Manager::create_random_animal());
// }
echo print_r($zooWatcher->get_cages(), true);
echo print_r($zooWatcher->find_animal('beast', 4, 1, 0));

