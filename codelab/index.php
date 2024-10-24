<?php
$rows = 5;

echo"1. Segitiga Sama Sisi";
echo"\n";
for ($i = 1; $i <= $rows; $i++) {
    for ($j = $i; $j < $rows; $j++) {
        echo " ";
    }
    for ($k = 1; $k <= (2 * $i - 1); $k++) {
        echo "*";
    }
    echo "\n";
}

echo"\n";

echo"2. Segitiga Sama Sisi Terbalik";
echo"\n";
for ($i = $rows; $i >= 1; $i--) {
    for ($j = $rows; $j > $i; $j--) {
        echo " ";
    }
    for ($k = 1; $k <= (2 * $i - 1); $k++) {
        echo "*";
    }
    echo "\n";
}
