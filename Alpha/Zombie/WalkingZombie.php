<?php


namespace Alpha\Zombie;

require_once __DIR__ . '/../Traits/DamageTrait.php';

use Alpha\Traits\DamageTrait;

class WalkingZombie extends Zombie
{
    private $ZombieHealth = 100;

    use DamageTrait;

    // public function destroyable()
    // {
    //     $damagePercentage = 20;
    //     $initialHealth = $this->ZombieHealth;
    //     $damage = $damagePercentage / 100 * $initialHealth;
    //     $this->ZombieHealth = (int) ($initialHealth - $damage);
    // }

    public function destroyable()
    {
        $this->applyDamage($this->ZombieHealth, 20);
    }

    public function getWalkingZombieInfo()
    {
        return $this->ZombieHealth;
    }
}
