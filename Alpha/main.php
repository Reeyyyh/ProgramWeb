<?php

require_once __DIR__ . '/Zombie/Zombie.php';
require_once __DIR__ . '/Items/Armor.php';
require_once __DIR__ . '/Zombie/ArmoredZombie.php';
require_once __DIR__ . '/Zombie/WalkingZombie.php';
require_once __DIR__ . '/Plant/Plant.php';

use Alpha\Plant\Plant;
use Alpha\Zombie\ArmoredZombie;
use Alpha\Zombie\WalkingZombie;

$plant = new Plant();
$walkingZombie = new WalkingZombie();
$armoredZombie = new ArmoredZombie();

$repeat = true;

while ($repeat) {
    echo "\nPilih yang mau di serang : ";
    echo "\n1.Zombie";
    echo "\n2.Armored Zombie";
    echo "\n0.Keluar game";
    echo "\nPilih target : ";

    $pilih = trim(fgets(STDIN));

    switch ($pilih) {
        case 1:
            if ($pilih == 1) {
                if ($walkingZombie->getWalkingZombieInfo() <= 0) {
                    echo "\nZombie telah mati\n";
                } else {
                    echo "\nPlant menyerang walking zombie";
                    echo "\nZombie health : " . $walkingZombie->getWalkingZombieInfo() . "\n";
                    $plant->Attack($walkingZombie);
                    echo "\n== Plant Attack ==\n";
                    echo "\nZombie health menjadi : " . $walkingZombie->getWalkingZombieInfo() . "\n";
                }
            }
            break;
        case 2:
            if ($armoredZombie->getArmorZombieInfo() <= 0) {
                echo "\nArmored Zombie telah mati\n";
            } else {
                echo "\nPlant menyerang Armored Zombie";
                echo "\nArmored health : " . $armoredZombie->getArmorInfo();
                echo "\nArmored Zombie health : " . $armoredZombie->getArmorZombieInfo() . "\n";
                $plant->Attack($armoredZombie);
                echo "\n== Plant Attack ==\n";
                echo "\nArmored health menjadi : " . $armoredZombie->getArmorInfo();
                echo "\nArmored Zombie health menjadi : " . $armoredZombie->getArmorZombieInfo() . "\n";
            }
            break;
        case 0:
            $repeat = false;
            echo "\nTerimakasih sudah bermain\n";
            break;
        default:
            echo "\nMusuh tidak tersedia\n";
            break;
    }
}
