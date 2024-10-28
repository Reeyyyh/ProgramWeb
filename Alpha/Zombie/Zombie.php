<?php

namespace Alpha\Zombie;

require_once __DIR__ . '/../classes/Destroyable.php';
use Alpha\classes\Destroyable;

abstract class Zombie implements Destroyable{
    
    abstract public function destroyable();

}