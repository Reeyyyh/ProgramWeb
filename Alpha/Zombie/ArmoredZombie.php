<?php

namespace Alpha\Zombie;

require_once __DIR__ . '/../Items/Armor.php';
require_once __DIR__ . '/../Traits/DamageTrait.php';

use Alpha\Items\Armor;
use Alpha\Traits\DamageTrait;

class ArmoredZombie extends Zombie
{
    private Armor $armor;
    private $ArmorZombieHealth = 100;

    use DamageTrait;

    public function __construct()
    {
        $this->armor = new Armor();
    }

    public function destroyable()
    {
        if ($this->armor->getArmorInfo() > 0) {
            $this->armor->destroyable();
        } else {
            $this->applyDamage($this->ArmorZombieHealth, 20);
        }
    }

    public function getArmorInfo()
    {
        return $this->armor->getArmorInfo();
    }

    public function getArmorZombieInfo()
    {
        return $this->ArmorZombieHealth;
    }
}
