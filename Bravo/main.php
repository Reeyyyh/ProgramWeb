<?php
echo "Masukkan Angka: ";
$angka = trim(fgets(STDIN)); 


function Inputan($angka) {
    if ($angka > 0) {
        return $angka;
    } else {
        echo "Harap masukkan bilangan bulat positif.\n";
        return false;
    }
}

function ShowData($angka) {
    for ($i = 1; $i <= $angka; $i++) {
        if ($i % 4 == 0 && $i % 6 == 0) {
            echo "Pemrograman Website 2024\n";
        } else if ($i % 5 == 0) {
            echo "2024\n";
        } else if ($i % 4 == 0) {
            echo "Pemrograman\n";
        } else if ($i % 6 == 0) {
            echo "Website\n";
        } else {
            echo $i . "\n";
        }
    }
}

if (Inputan($angka)) {
    ShowData($angka);
}