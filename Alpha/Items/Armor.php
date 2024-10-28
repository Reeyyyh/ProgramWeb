<?php

namespace Alpha\Items;

require_once __DIR__ . '/../classes/Destroyable.php';
require_once __DIR__ . '/../Traits/DamageTrait.php';

use Alpha\classes\Destroyable;
use Alpha\Traits\DamageTrait;

class Armor implements Destroyable
{

    private int $ArmorHealth = 100;

    use DamageTrait;

    public function destroyable()
    {
        $this->applyDamage($this->ArmorHealth, 20);
    }

    public function getArmorInfo()
    {
        return $this->ArmorHealth;
    }
}
