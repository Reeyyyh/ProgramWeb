<?php

namespace Alpha\Plant;

require_once __DIR__ . '/../classes/Destroyable.php';
require_once __DIR__ . '/../Zombie/ArmoredZombie.php';
require_once __DIR__ . '/../Zombie/WalkingZombie.php';


use Alpha\classes\Destroyable;
use Alpha\Zombie\ArmoredZombie;
use Alpha\Zombie\WalkingZombie;

class Plant
{
    public function Attack(Destroyable $destroy)
    {
        if ($destroy instanceof WalkingZombie) {
            $destroy->destroyable();
        } else if ($destroy instanceof ArmoredZombie) {
            $destroy->destroyable();
        }
    }
}

