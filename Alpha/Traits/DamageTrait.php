<?php

namespace Alpha\Traits;

trait DamageTrait
{
    public function applyDamage(&$health, $damagePercentage)
    {
        $damage = $damagePercentage / 100 * $health;
        $health = (int) ($health - $damage);
    }
}